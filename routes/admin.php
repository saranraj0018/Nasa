<?php

use App\Http\Controllers\admin\AdminAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
Route::view('/login', 'auth.admin_login')->name('login');
Route::post('/login', [AdminAuthController::class, 'index'])->name('role_check.login');
});
