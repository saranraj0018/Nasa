<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;
    protected $guard = 'student';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password'];

    public function get_department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function get_programme()
    {
        return $this->belongsTo(Programme::class, 'programme_id');
    }
}
