<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public function get_department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function get_designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
