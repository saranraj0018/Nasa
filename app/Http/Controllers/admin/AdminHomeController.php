<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventReport;
use App\Models\StudentEventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{
    public function index(Request $request)
    {
        $adminId = Auth::guard('admin')->id();
        $today = now();
        $this->data['events'] = Event::where('created_by',  $adminId)->get();
        $this->data['upcoming_events'] = Event::where('created_by', $adminId)
            ->whereDate('event_date', '>=', $today)
            ->orderBy('event_date', 'asc')
            ->get();
        $this->data['pending_approvals'] = StudentEventRegistration::with('event')
                                             ->whereHas('event' , function($query) use($adminId) {
                                                 $query->where('created_by',  $adminId);
                                             })
                                             ->where('status',1)
                                             ->get();
                                  
        $this->data['submitted_reports'] = EventReport::where('created_by', $adminId)->get();
        return view('admin.admin_home_index')->with($this->data);
    }
}
