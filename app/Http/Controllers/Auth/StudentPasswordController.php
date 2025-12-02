<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentPasswordController extends Controller
{
    public function showEmailForm()
    {
        return view('student.auth.forgot');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $student = Student::where('email', $request['email'])->first();

        if (!$student) {
            return redirect()->route('student.password.forgot')
                ->withErrors(['email' => 'Email does not exist!'])
                ->withInput($request->only('email'));
        }

        return view('student.auth.update_password', ['email' => $request->email]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'password.confirmed' => 'Passwords do not match.'
       ]);

        $student = Student::where('email', $request->email)->first();
        if (!$student) {
            return back()->withErrors(['email' => 'Invalid request']);
        }

        $student->password = Hash::make($request->password);
        $student->save();

        return redirect()->route('login')->with('status', 'Password updated successfully');
    }
}
