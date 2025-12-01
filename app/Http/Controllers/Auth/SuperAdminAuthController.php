<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class SuperAdminAuthController extends Controller
{
    public function index(Request $request)
    {
        $this->data['credential_value'] = $request->all();
        return view('super_admin.super_admin_security_check')->with($this->data);
    }

    public function securityCheck(Request $request)
    {
        $this->data['credential_value'] = $request->all();

        if($request->method() == 'POST'){
            $superAdminId = session()->get('super_admin');
            $admin = Admin::where(['id' =>  $superAdminId->id,'security_code' => $request->verification_code,'role_id' => 1])->first();
            if(!$admin){
                if(!empty(session()->get('admin'))){
                    return redirect()->route('admin.security_check')
                        ->withErrors(['verification_code' => 'You do not have access to the Super Admin portal.'])
                        ->withInput($request->only('verification_code'));
                }
                return redirect()->route('admin.security_check')
                    ->withErrors(['verification_code' => 'Invalid Security Code'])
                    ->withInput($request->only('verification_code'));
            }
            session()->put('security_verified', true);
            return redirect()->route('super_admin_home');
        }

        return view('super_admin.super_admin_security_check')->with($this->data);
    }
}
