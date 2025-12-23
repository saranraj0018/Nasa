<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFeedback extends Model
{
   protected $table = 'student_feedbacks';

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
