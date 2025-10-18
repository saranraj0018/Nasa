<?php

use App\Http\Controllers\student\StudentDashboardController;
use Illuminate\Support\Facades\Route;



Route::prefix('student')->group(function () {

    // Route::middleware(['guest'])->as('admin.')->group(function () {
        Route::view('/login', 'auth.login')->name('login');
    // Route::view('/register', 'auth.register')->name('register');
     Route::get('/student-dashboard', [StudentDashboardController::class, 'index'])->name('student_dashboard');
    // });

});
