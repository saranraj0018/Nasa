<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function index(Request $request)
    {
        $this->data['credential_value'] = $request->all();
        $prefix = request()->route()->getPrefix();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!$validator->passes()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        if (!Auth::guard('admin')->attempt($credentials, $request->get('remember'))) {
            return redirect()->route('login')
                ->withErrors(['password' => 'Either Email/Password is incorrect'])
                ->withInput($request->only('email'));
        }

        $admin = Auth::guard('admin')->id();
        $admin_details = Admin::where('id', $admin)->first();
        if($admin_details->role_id == 1){
            session()->put('super_admin', $admin_details);
            session()->forget('admin');
            session()->forget('student');
        }else{
            session()->put('admin', $admin_details);
            session()->forget('student');
            session()->forget('super_admin');
        }

        return view('admin.role_check_login')->with($this->data);
    }
}
