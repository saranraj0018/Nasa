<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminHomeController extends Controller
{
    public function index(Request $request)
    {

        return view('super_admin.super_admin_home')->with($this->data);
    }
}
