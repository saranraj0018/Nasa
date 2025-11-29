<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Admin;
use App\Models\Event;
use App\Models\Student;
use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminHomeController extends Controller
{
    public function index(Request $request)
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();
        $adminId = Auth::guard('admin')->id();
        $this->data['upcomingEvents'] = Event::whereDate('event_date', '>', now())->count();
        $this->data['ongoingEvents'] = Event::whereDate('event_date', '=', now())->count();
        $this->data['totalAdmins'] = Admin::where('role_id',2)->count();
        $this->data['totalStudents'] = Student::count();
        $this->data['upcomingEventsThisWeek'] = Event::whereBetween('event_date', [$startOfWeek, $endOfWeek])
            ->where('event_date', '>', now())
            ->count();
        $this->data['adminsThisMonth'] = Admin::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $this->data['studentsThisMonth'] = Student::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $this->data['submittedReports'] = Tasks::where('created_by', $adminId)
            ->whereHas('get_event.get_report')
            ->count();

        // Pending = tasks whose event exists but report not created
        $this->data['pendingReports'] = Tasks::where('created_by', $adminId)
            ->doesntHave('get_event')
            ->count();
        $this->data['thisweeksubmittedReports'] = Tasks::where('created_by', $adminId)
            ->whereHas('get_event', function ($q) use ($startOfWeek, $endOfWeek) {
                $q->whereBetween('event_date', [$startOfWeek, $endOfWeek]) // adjust field name
                    ->whereHas('get_report');
            })
            ->count();

        // Pending = event exists but report not created
        $this->data['thisweekpendingReports'] = Tasks::where('created_by', $adminId)
            ->whereHas('get_event', function ($q) use ($startOfWeek, $endOfWeek) {
                $q->whereBetween('event_date', [$startOfWeek, $endOfWeek])
                    ->whereDoesntHave('get_report');
            })
            ->count();
        $this->data['activities'] = Activity::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'DESC')
            ->get();

        return view('super_admin.super_admin_home')->with($this->data);
    }
}
