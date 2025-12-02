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

    public function get_task()
    {
        return $this->hasMany(Tasks::class, 'task_id');
    }

    public function get_creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function get_event()
    {
        return $this->belongsTo(Event::class, 'id','task_id');
    }
}
