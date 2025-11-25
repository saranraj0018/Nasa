<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminReportsController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.admin_reports_index')->with($this->data);
    }

    public function crearteReport(Request $request)
    {
        return view('admin.create_admin_report')->with($this->data);
    }
}
