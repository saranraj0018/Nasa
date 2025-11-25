<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Event;
use App\Models\Faculty;
use App\Models\StudentEventRegistration;
use Carbon\Carbon;
use Exception;
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
        $this->data['faculty'] = Faculty::get();
        $this->data['club'] = Club::get();
        if($request->event_id){
            $eventId = decrypt($request->event_id);
            $this->data['edit_event'] = Event::where('id', $eventId)->first();
            $this->data['edit_faculty'] = Faculty::where('id', $this->data['edit_event']->faculty_id)->first();
        }
         if($request->ajax()){
            if($request->get_programme_officer){
                $get_faculty = Club::with('get_faculty')->where('id',$request->clubId)->first();
                return response()->json([
                     'success' => true,
                     'faculty' => $get_faculty
                ]);
            }
        }
        return view('super_admin.create_event')->with($this->data);
    }

    public function eventlist(Request $request)
    {
        $this->data['events'] = Event::with('get_faculty')->paginate(10);
        return view('super_admin.event_list')->with($this->data);
    }

    public function saveEvent(Request $request)
    {

        $rules = [
            'event_title'   => 'required',
            'club_id'   => 'required',
            'programme_officer'   => 'required',
            'description'   => 'required',
            'event_date'   => 'required',
            'start_time'   => 'required',
            'end_time'   => 'required',
            'location'   => 'required',
            'session'   => 'required',
            'eligibility'   => 'required',
            'registration_deadline'   => 'required',
            'contact_person'   => 'required',
            'contact_email'   => 'required',
            'seat_count'   => 'required',
            'event_type'   => 'required'
        ];

        if (empty($request['event_id']) && !$request->has('old_banner')) {
            $rules['banner_image'] = 'required|image|mimes:jpeg,png,jpg';
        } else if ($request->hasFile('banner_image')) {
            $rules['banner_image'] = 'image|mimes:jpeg,png,jpg';
        }
        $request->validate($rules);
        try {
            if (!empty($request['event_id'])) {
                $message = 'Event Updated successfully';
                $event = Event::find($request['event_id']);
            } else {
                $event = new Event();
                $message = 'Event saved successfully';
            }

            if ($request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $img_name = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('event_banner', $img_name , 'public');
                $event->banner_image = 'event_banner/' . $img_name;
            } elseif ($request->has('old_banner')) {
                $event->banner_image = $request->old_banner;
            }

            $event->club_id  = $request['club_id'];
            $event->faculty_id = $request['programme_officer'] ?? '';
            $event->title  = $request['event_title'] ?? '';
            $event->description = $request['description'] ?? '';
            $event->event_date = $request['event_date'] ?? '';
            $event->start_time  = $request['start_time'] ?? '';
            $event->end_time = $request['end_time']  ?? '';
            $event->event_type = $request['event_type'] ?? '';
            $event->seat_count = $request['seat_count'] ?? '';
            $event->location  = $request['location'] ?? '';
            $event->session = $request['session']  ?? '';
            $event->eligibility_criteria = $request['eligibility']  ?? '';
            $event->end_registration = $request['registration_deadline']  ?? '';
            $event->contact_person = $request['contact_person']  ?? '';
            $event->contact_email = $request['contact_email']  ?? '';
            $event->save();

            return response()->json([
                'success' => true,
                'message' => $message,
                'event' => $event,
            ]);
    } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save event',
                'error' => $e->getMessage(),
            ], 500);
        }
}
}
