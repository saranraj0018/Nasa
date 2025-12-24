<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function get_grade()
    {
        return $this->belongsTo(StudentEventRegistration::class, 'student_id', 'student_id');
    }

}
