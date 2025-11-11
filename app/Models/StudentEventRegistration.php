<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEventRegistration extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
