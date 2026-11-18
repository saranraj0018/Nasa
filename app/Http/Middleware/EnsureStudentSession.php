<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controllers and views read the logged-in student from session('student'),
 * which is only set at login. When the student guard re-authenticates from the
 * "remember me" cookie (after the session expires) or the key is cleared by an
 * admin login in the same browser, the guard is still authenticated but the
 * session key is gone, causing "Attempt to read property 'id' on null".
 * Re-populate it from the authenticated student.
 */
class EnsureStudentSession
{
    public function handle(Request $request, Closure $next): Response
    {
        $student = Auth::guard('student')->user();

        if ($student && empty(session()->get('student'))) {
            session()->put('student', $student);
        }

        return $next($request);
    }
}
