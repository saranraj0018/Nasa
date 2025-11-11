<?php

use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\student\CertificatesController;
use App\Http\Controllers\student\MyRegisterEventsController;
use App\Http\Controllers\student\RegisterEventController;
use App\Http\Controllers\student\StudentDashboardController;
use Illuminate\Support\Facades\Route;



Route::prefix('student')->group(function () {
    Route::middleware(['guest'])->as('student.')->group(function () {
        Route::view('/login', 'auth.login')->name('login');
        Route::post('/login', [StudentAuthController::class, 'login'])->name('student.login');
    });
    Route::middleware('auth:student')->group(function () {
        Route::get('/student-dashboard', [StudentDashboardController::class, 'index'])->name('student_dashboard');
        Route::get('/register-events', [RegisterEventController::class, 'index'])->name('register_events');

        //save events
        Route::post('/student-register-event', [RegisterEventController::class, 'studentRegisterEvent'])->name('student_register_event');
        Route::get('/get-student', [RegisterEventController::class, 'getStudent'])->name('get_student');
        //My Registration
        Route::get('/my-register-events', [MyRegisterEventsController::class, 'index'])->name('my_register_events');
        Route::post('/upload-proof', [MyRegisterEventsController::class, 'uploadProof'])->name('upload_proof');

        //certificates
        Route::post('/logout', [StudentAuthController::class, 'logout'])->name('student.logout');
        Route::get('/certificates', [CertificatesController::class, 'index'])->name('certificates');
        Route::get('/certificate_download', [CertificatesController::class, 'downloadCertificate'])->name('certificate_download');
    });
});

