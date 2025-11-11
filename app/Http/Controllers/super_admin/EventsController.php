<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\StudentEventRegistration;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        $this->data['ongoingEvents'] = Event::whereDate('event_date', $now->toDateString())
            // ->whereTime('start_time', '<=', $now->toTimeString())
            // ->whereTime('end_time', '>=', $now->toTimeString())
            ->where('end_registration', '>=', $now) // not after registration deadline
            ->get();
        $this->data['upcomingEvents'] = Event::where(function ($query) use ($now) {
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
        $this->data['registeredEvents'] = StudentEventRegistration::with('event')
            ->get();
        $this->data['completedEvents'] = StudentEventRegistration::with('event')
            ->get();
         return view('super_admin.event_index')->with($this->data);
    }

    public function createEvent(Request $request)
    {

        return view('super_admin.create_event')->with($this->data);

    }
}
