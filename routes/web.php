<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'student/login');

require __DIR__ . '/student.php';
require __DIR__ . '/admin.php';
