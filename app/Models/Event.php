<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function registrations()
    {
        return $this->hasMany(StudentEventRegistration::class, 'event_id');
    }

    public function get_faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function get_task()
    {
        return $this->belongsTo(Tasks::class, 'task_id');
    }
}
