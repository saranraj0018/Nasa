<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\StudentEventRegistration;
use Illuminate\Http\Request;

class StudentApprovalController extends Controller
{
    public function index()
    {
        $this->data['registeredEvents'] = StudentEventRegistration::with('event')->get();
        return view('super_admin.student_approval_index')->with($this->data);
    }
}
