<?php

namespace App\Http\Controllers\admin;

use App\Exports\AttendanceExport;
use Illuminate\Http\Request;
use App\Models\StudentAttendance;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSchedule;
use App\Models\StudentEventRegistration;
use App\Traits\ResolvesEventSchedule;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class StudentAttendanceController extends Controller
{
    use ResolvesEventSchedule;

    public function index()
    {
        $adminId = Auth::guard('admin')->id();
        if (!empty(session()->get('super_admin'))) {
            $this->data['events'] = Event::with('get_club')
                ->where([
                'publish' => 1 ,
                'is_active' => 'y'
                ])
                ->paginate(10);
        } else {
            $this->data['events'] = Event::with('get_club')
                ->where('created_by', $adminId)
                ->where([
                'publish' => 1,
                'is_active' => 'y'
                ])
                ->paginate(10);
        }
        return view('admin.student_attendance_index')->with($this->data);
    }

    public function attendanceEntry(Request $request)
    {
        $eventId = $request->event_id;

        $event = Event::findOrFail($eventId);
        $this->data['event'] = $event;
        $this->data['registeredStudents'] = collect();
        $this->data['attendance_entry'] = collect();

        if ($event->is_first_year === 'y') {
            // First-year events have no programme/section/batch/semester to filter
            // by (their schedule is common to all first-years) — show everyone
            // registered for the event directly, no search step needed.
            $this->data['attendance_entry'] = StudentAttendance::where('event_id', $eventId)->get();

            $this->data['registeredStudents'] =
                StudentEventRegistration::with('student.get_department', 'student.get_programme')
                ->where('event_id', $eventId)
                ->get();
        } else {
            $this->data['get_schedule_event'] = EventSchedule::with('programme')
                ->where('event_id', $eventId)
                ->distinct('programme_id')
                ->get(['programme_id', 'event_id']);

            if ($request->filled('programme_id') && $request->filled('event_date')) {
                $schedule = $this->resolveSchedule(
                    $eventId,
                    $request->programme_id,
                    $request->event_date,
                    $request->section,
                    $request->batch,
                    $request->semester
                );

                if (!empty($schedule)) {
                    $this->data['attendance_entry'] = StudentAttendance::where('event_id', $eventId)
                        ->where('event_schedule_id', $schedule->id)
                        ->get();

                    $this->data['registeredStudents'] =
                        StudentEventRegistration::with('student.get_department', 'student.get_programme')
                        ->where('event_id', $eventId)
                        ->where('event_schedule_id', $schedule->id)
                        ->get();
                }
            }
        }
        return view('admin.student_attendance_entry')->with($this->data);
    }

    public function download(Request $request)
    {
        $event_id = Event::where('id', $request->event_id)->first();
        $fileName = $event_id->title . '_' . 'student_attendance_' . date('Y-m-d') . '.xlsx';
        return Excel::download(new AttendanceExport($event_id->id), $fileName);
    }

    public function markAttendance(Request $request)
    {
        $request->validate([
            'event_id'   => 'required|exists:events,id',
            'attendance' => 'required|array'
        ]);
        DB::beginTransaction();
        try {
            $event = Event::findOrFail($request->event_id);

            // Non-first-year events are marked against a single schedule resolved
            // from the page's programme/section/batch/semester filter. First-year
            // events have no such filter — each student row already carries its
            // own schedule_id (the common schedule they registered under).
            $defaultSchedule = null;
            if ($event->is_first_year !== 'y') {
                $defaultSchedule = $this->resolveSchedule(
                    $request->event_id,
                    $request->programme_id,
                    $request->event_date,
                    $request->section,
                    $request->batch,
                    $request->semester
                );

                if (empty($defaultSchedule)) {
                    throw new Exception('Schedule not found');
                }
            }

            foreach ($request->attendance as $studentId => $data) {
                $scheduleId = $data['schedule_id'] ?? $defaultSchedule?->id;

                if (empty($scheduleId)) {
                    throw new Exception("Schedule missing for student ID: {$studentId}");
                }

                $attendance = StudentAttendance::firstOrNew([
                    'event_id' => $request->event_id,
                    'student_id' => $studentId,
                    'event_schedule_id' => $scheduleId
                ]);

                if ($data['entry'] == 1) {
                    if (!$attendance->entry_time) {
                        $attendance->entry_time = now();
                    }
                } else {
                    $attendance->entry_time = null;
                }

                if ($data['exit'] == 1) {
                    if (!$attendance->exit_time) {
                        $attendance->exit_time = now();
                    }
                } else {
                    $attendance->exit_time = null;
                }

                $attendance->save();

                StudentEventRegistration::where([
                    'event_id' => $request->event_id,
                    'student_id' => $studentId,
                    'event_schedule_id' => $scheduleId
                ])->update([
                    'status' => ($attendance->entry_time && $attendance->exit_time) ? 3 : 2
                ]);
            }
            DB::commit();
            return back()->with('success', 'Attendance saved successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
