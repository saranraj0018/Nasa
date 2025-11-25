<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    public function get_admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function get_task_images()
    {
        return $this->hasMany(TaskImage::class, 'task_id');
    }
}
