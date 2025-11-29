<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\Configuration\Php;

class AdminGuest
{
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();
            // If verification is pending
            if ($user->role === 1 && !session()->get('security_verified')) {
                return redirect()->route('superadmin_security');
            }
            // After verification
            if ($user->role === 1 && session()->get('security_verified')) {
                return redirect()->route('super_admin_home');
            }
            if ($user->role === 2) {
                return redirect()->route('home');
            }
        }
        return $next($request);
    }
}
