<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewReportsController extends Controller
{
    public function index()
    {
         return view('super_admin.review_reports_index')->with($this->data);
    }
}
