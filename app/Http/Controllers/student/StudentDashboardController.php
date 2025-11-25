<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\StudentEventRegistration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        $student = session()->get('student');
        $this->data['events'] = Event::get();
        $this->data['registered_count'] = StudentEventRegistration::where('student_id', $student->id)->get();
        $this->data['completed_events'] = StudentEventRegistration::where('student_id', $student->id)->where('status', 3)->get();
        $this->data['ongoingEvents'] = Event::with('registrations')
            ->whereDate('event_date', $now->toDateString())
            // ->whereTime('start_time', '<=', $now->toTimeString())
            // ->whereTime('end_time', '>=', $now->toTimeString())
            ->where('end_registration', '>=', $now) // not after registration deadline
            ->get();
        $this->data['upcomingEvents'] = Event::with('registrations')
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
        $this->data['registeredEvents'] = StudentEventRegistration::with('event')->where('student_id', $student->id)
            ->get();
        return view('student.student_dashboard')->with($this->data);
    }
}
