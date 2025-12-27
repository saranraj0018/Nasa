<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrivacyPolicyController;

Route::redirect('/', 'student/login');

Route::get('privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy_policy');
Route::get('terms-and-condition', [PrivacyPolicyController::class, 'termsConditions'])->name('terms_and_conditions');

require __DIR__ . '/student.php';
require __DIR__ . '/admin.php';
