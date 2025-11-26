<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Student;
use App\Models\StudentEventRegistration;
use Illuminate\Http\Request;

class StudentApprovalController extends Controller
{
    public function index()
    {
        $this->data['registeredEvents'] = StudentEventRegistration::with('event','student','get_student_proof')->get();
        $this->data['pending'] = StudentEventRegistration::where('status' , 1)->count();
        $this->data['present'] = StudentEventRegistration::where('status', 2)->count();
        $this->data['absent'] = StudentEventRegistration::where('status', 4)->count();
        $this->data['students'] = Student::get();
        $this->data['event'] = Event::get();
        return view('super_admin.student_approval_index')->with($this->data);
    }

    public function studentEventApproval(Request $request)
    {

        $update = StudentEventRegistration::where('id',$request->id)->update([
            'status' => $request->action
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status Updated Successfully!'
        ]);

    }
}
