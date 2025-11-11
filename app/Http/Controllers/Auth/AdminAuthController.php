<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function index(Request $request)
    {
        $this->data['credential_value'] = $request->all();
        return view('admin.role_check_login')->with($this->data);
    }
}
