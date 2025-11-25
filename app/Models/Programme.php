<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    public function get_department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
