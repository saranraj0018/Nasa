<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPasswordController extends Controller
{
    public function showEmailForm()
    {
        return view('admin.auth.admin_forgot');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $admin = Admin::where('email', $request['email'])->first();

        if (!$admin) {
            return redirect()->route('admin.password.forgot')
                ->withErrors(['email' => 'Email does not exist!'])
                ->withInput($request->only('email'));
        }

        return view('admin.auth.admin_update_password', ['email' => $request->email]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'password.confirmed' => 'Passwords do not match.'
       ]);

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return back()->withErrors(['email' => 'Invalid request']);
        }

        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('login')->with('status', 'Password updated successfully');
    }
}
