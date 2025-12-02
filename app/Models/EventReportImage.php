<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventReportImage extends Model
{
    public function report()
    {
        return $this->belongsTo(EventReport::class, 'report_id');
    }

     public function url()
    {
         return asset('storage/' . ltrim($this->file_path, '/'));
    }
}
