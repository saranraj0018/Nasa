<?php

use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\Auth\SuperAdminAuthController;
use App\Http\Controllers\super_admin\AssignTasksController;
use App\Http\Controllers\super_admin\EventsController;
use App\Http\Controllers\super_admin\ReviewReportsController;
use App\Http\Controllers\super_admin\StudentApprovalController;
use App\Http\Controllers\super_admin\SuperAdminHomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('super-admin')->group(function () {
    Route::view('/login', 'auth.super_admin_login')->name('login');
    Route::post('/login', [SuperAdminAuthController::class, 'index'])->name('security_check.login');

    Route::get('/home', [SuperAdminHomeController::class, 'index'])->name('super_admin_home');
    Route::get('/events', [EventsController::class, 'index'])->name('events');
    Route::get('/create-event', [EventsController::class, 'createEvent'])->name('create_event');

    //Assign Tasks
    Route::get('/assign-tasks', [AssignTasksController::class, 'index'])->name('assign_tasks');
    Route::get('/student-approval', [StudentApprovalController::class, 'index'])->name('student_approval');
    Route::get('/review-reports', [ReviewReportsController::class, 'index'])->name('review_reports');
});
