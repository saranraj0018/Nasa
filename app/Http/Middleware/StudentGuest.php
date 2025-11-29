<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentGuest
{
    public function handle($request, Closure $next, $guard = 'student')
    {
        if (Auth::guard($guard)->check()) {
            return redirect()->route('student_dashboard'); 
        }
        return $next($request);
    }
}
