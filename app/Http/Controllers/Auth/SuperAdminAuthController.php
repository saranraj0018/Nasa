<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminAuthController extends Controller
{
    public function index(Request $request)
    {
        $this->data['credential_value'] = $request->all();
        return view('super_admin.super_admin_security_check')->with($this->data);
    }
}
