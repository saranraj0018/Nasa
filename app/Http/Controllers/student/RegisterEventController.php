<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Student;
use App\Models\StudentEventRegistration;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterEventController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        $this->data['events'] = Event::get();
        $student = session()->get('student');
        $this->data['ongoingEvents'] = Event::whereDoesntHave('registrations', function ($query) use ($student) {
            $query->where('student_id', $student);
        })
            ->whereDate('event_date', $now->toDateString())
            // ->whereTime('start_time', '<=', $now->toTimeString())
            // ->whereTime('end_time', '>=', $now->toTimeString())
            ->where('end_registration', '>=', $now) // not after registration deadline
            ->get();
        $this->data['upcomingEvents'] = Event::whereDoesntHave('registrations', function ($query) use ($student) {
            $query->where('student_id', $student);
        })
            ->where(function ($query) use ($now) {
                $query->whereDate('event_date', '>', $now->toDateString())
                    ->orWhere(function ($q) use ($now) {
                        $q->whereDate('event_date', '=', $now->toDateString());
                        //    ->whereTime('start_time', '>', $now->toTimeString());
                    });
            })
            ->where('end_registration', '>=', $now)
            ->orderBy('event_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();
        return view('student.register_event_index')->with($this->data);
    }

    public function studentRegisterEvent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string|max:255',
            'event'  => 'required',
         ]);

         try {
            $register_event = StudentEventRegistration::where(['student_id' => $request->stu_id, 'event_id' => $request->event_id])->first();
            if (!$register_event) {
                $register = new StudentEventRegistration();
                $register->student_id    = $request->stu_id;
                $register->event_id      = $request->event_id ?? null;
                $register->status        = 1;
                $register->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Event Registered Successfully!',
             ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to Register Event',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function getStudent(Request $request)
    {
        if($request->ajax() && $request->get_student){
            $studentID = session()->get('student');
            $student = Student::where('id', $studentID)->first();
            $event = Event::where('id',$request->event_id)->first();
              return response()->json([
                'success' => true,
                'student' => $student,
                'event' => $event
             ]);
        }
    }
}
