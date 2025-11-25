<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Event;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SuperAdminHomeController extends Controller
{
    public function index(Request $request)
    {
        $startOfWeek = Carbon::now()->startOfWeek();   // Monday
        $endOfWeek   = Carbon::now()->endOfWeek();
        $this->data['upcomingEvents'] = Event::whereDate('event_date', '>', now())->count();
        $this->data['ongoingEvents'] = Event::whereDate('event_date', '=', now())->count();
        $this->data['totalAdmins'] = Admin::where('role_id',2)->count();  // or User::where('role', 'admin')->count();
        $this->data['totalStudents'] = Student::count();
        $this->data['upcomingEventsThisWeek'] = Event::whereBetween('event_date', [$startOfWeek, $endOfWeek])
            ->where('event_date', '>', now()) // upcoming only
            ->count();
        $this->data['adminsThisMonth'] = Admin::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $this->data['studentsThisMonth'] = Student::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        // $pendingReports = Report::where('status', 'pending')->count();
        // $submittedReports = Report::where('status', 'submitted')->count();

        return view('super_admin.super_admin_home')->with($this->data);
    }
}
