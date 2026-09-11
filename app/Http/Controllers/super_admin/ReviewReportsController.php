<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventReport;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewReportsController extends Controller
{
    public function index(Request $request)
    {
        $adminId = Auth::guard('admin')->id();
        $this->data['events'] = Event::with('registrations')
        ->where('created_by', $adminId)
        ->where(['publish' => 1,
        'is_active' => 'y'
        ])
        ->get();

        $query = EventReport::with('creator', 'get_event_image', 'get_event.get_task', 'schedule.department', 'get_programme', 'get_event')
            ->whereHas('get_event', function ($eventQuery) {
                $eventQuery->where('publish', 1)
                    ->where('is_active', 'y');
            });

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('get_event', function ($eventQuery) use ($search) {
                $eventQuery->where('title', 'like', "%{$search}%");
            });
        }

        if ($request->filled('programme_id')) {
            $query->where('programme_id', $request->programme_id);
        }

        if ($request->filled('event_date')) {
            $query->whereDate('event_date', $request->event_date);
        }

        $this->data['reports'] = $query->get();
        $this->data['programmes'] = Programme::orderBy('name')->get();
        return view('super_admin.review_reports_index')->with($this->data);
    }
}
