<?php

namespace App\Http\Controllers;

use App\Exports\CreditSummaryExport;
use App\Models\CreditPoint;
use App\Models\Programme;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CreditSummaryReportController extends Controller
{
    public function index(Request $request)
    {
        $this->data['programmes'] = Programme::orderBy('name')->get();

        if ($request->filled('programme_id') && $request->filled('semester')) {
            $this->data = array_merge($this->data, $this->buildReport($request));
        }

        return view('admin.credit_summary_report')->with($this->data);
    }

    public function exportExcel(Request $request)
    {
        $report = $this->buildReport($request);

        return Excel::download(
            new CreditSummaryExport($report['rows'], $report),
            $this->fileName($report, 'xlsx')
        );
    }

    public function exportPdf(Request $request)
    {
        $report = $this->buildReport($request);

        $pdf = Pdf::loadView('admin.credit_summary_report_pdf', $report)
            ->setPaper('a4', 'landscape');

        return $pdf->download($this->fileName($report, 'pdf'));
    }

    /**
     * Semester + programme wise credit summary for each student:
     * required credits for the semester, credits earned, and credits remaining.
     */
    private function buildReport(Request $request): array
    {
        $request->validate([
            'programme_id' => 'required|exists:programmes,id',
            'semester'     => 'required|in:1,2,3,4,5,6,7,8',
            'section'      => 'nullable|in:a,b,c,d,e,f,r',
        ]);

        $semester = (string) $request->semester;
        $programme = Programme::find($request->programme_id);
        $creditPoint = CreditPoint::where('semester', $semester)->first();
        $required = (float) ($creditPoint->credit_points ?? 0);

        // Only events that are published/active and scheduled for this semester
        // (schedules without a semester are common events and count too).
        $registrationScope = function ($query) use ($semester) {
            $query->whereHas('get_event_schedule', function ($schedule) use ($semester) {
                $schedule->where(function ($q) use ($semester) {
                    $q->where('semester', $semester)->orWhereNull('semester');
                })->whereHas('event', function ($event) {
                    $event->where('publish', 1)->where('is_active', 'y');
                });
            });
        };

        $students = Student::query()
            ->where('programme_id', $request->programme_id)
            ->where('semester', $semester)
            ->when($request->filled('section'), fn ($q) => $q->where('section', $request->section))
            ->with([
                'get_programme',
                'registrations' => $registrationScope,
                'registrations.get_event_schedule.event',
            ])
            ->orderBy('section')
            ->orderBy('register_number')
            ->get();

        $rows = $students->map(function ($student) use ($required) {
            $events = $student->registrations->map(function ($registration) {
                $grade = $registration->grade;

                return [
                    'title'   => $registration->get_event_schedule->event->title ?? '',
                    'credits' => (float) ($registration->get_event_schedule->credit_points ?? 0),
                    'counted' => !empty($grade) && $grade !== 'd',
                    'note'    => empty($grade) ? 'Grade pending' : ($grade === 'd' ? 'Disqualified' : null),
                ];
            });

            $totalEarned = $events->where('counted', true)->sum('credits');
            $earned = $required > 0 ? min($totalEarned, $required) : $totalEarned;
            $remaining = max($required - $earned, 0);

            return [
                'student'      => $student,
                'events'       => $events,
                'total_earned' => $totalEarned,
                'earned'       => $earned,
                'remaining'    => $remaining,
                'completed'    => $required > 0 && $remaining <= 0,
            ];
        });

        return [
            'rows'          => $rows,
            'progm'         => $programme,
            'credit_points' => $creditPoint,
            'required'      => $required,
            'semester'      => $semester,
            'section'       => $request->section,
            'summary'       => [
                'students'  => $rows->count(),
                'completed' => $rows->where('completed', true)->count(),
                'pending'   => $rows->where('completed', false)->count(),
            ],
        ];
    }

    private function fileName(array $report, string $extension): string
    {
        $parts = [
            'credit_report',
            Str::slug($report['progm']->name ?? 'programme', '_'),
            'sem_' . $report['semester'],
        ];

        if (!empty($report['section'])) {
            $parts[] = 'sec_' . strtoupper($report['section']);
        }

        return implode('_', $parts) . '.' . $extension;
    }

    public static function formatCredits($value): string
    {
        $value = (float) $value;

        return fmod($value, 1) == 0 ? (string) (int) $value : rtrim(rtrim(number_format($value, 2, '.', ''), '0'), '.');
    }
}
