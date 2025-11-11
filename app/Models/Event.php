<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function registrations()
    {
        return $this->hasMany(StudentEventRegistration::class, 'event_id');
    }
}
