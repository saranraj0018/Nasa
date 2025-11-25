<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    public function get_faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }
}
