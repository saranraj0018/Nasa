<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller
{
    use HandlesAuthorization, DispatchesJobs, ValidatesRequests;
    protected array $data = [];
}
