<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    protected $fillable = [
        'event_id',
        'programme_id',
        'section',
        'event_date',
        'is_reserve_date',
        'seat_count',
        'batch',
        'semester',
        'year',
        'credit_points'
    ];

    public function registrations()
    {
        return $this->hasMany(StudentEventRegistration::class, 'event_id', 'event_id');
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class, 'programme_id');
    }

    public function get_report()
    {
        return $this->hasOne(EventReport::class, 'event_schedule_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * A schedule with programme_id/section/semester all null is a
     * "common first year" schedule (open to any dept/section, semester 1 or 2 only).
     * Batch, if set, still narrows it to that admission batch.
    */
    public function isCommonFirstYearSchedule($student = null): bool
    {
        if (!is_null($this->programme_id) || !is_null($this->section) || !is_null($this->semester)) {
            return false;
        }

        if (is_null($this->batch) || is_null($student)) {
            return true;
        }

        return $this->batch == $student->batch;
    }

    public static function isFirstYearStudent($student): bool
    {
        return in_array((string) $student->semester, ['1', '2']);
    }

    /**
     * Restricts a query to schedules that apply to the given student:
     * either an exact programme/section/batch/semester match, or (for
     * semester 1/2 students only) a common first-year schedule.
    */
    public function scopeMatchesStudent($query, $student)
    {
        $isFirstYearStudent = self::isFirstYearStudent($student);

        return $query->where(function ($q) use ($student, $isFirstYearStudent) {
            $q->where('programme_id', $student->programme_id)
                ->where('section', $student->section)
                ->where('batch', $student->batch)
                ->where('semester', $student->semester);

            if ($isFirstYearStudent) {
                $q->orWhere(function ($fy) use ($student) {
                    $fy->whereNull('programme_id')
                        ->whereNull('section')
                        ->whereNull('semester')
                        ->where(function ($b) use ($student) {
                            $b->whereNull('batch')->orWhere('batch', $student->batch);
                        });
                });
            }
        });
    }

    /**
     * Count of students already registered for this schedule that
     * compete for the same seats as the given student.
     */
    public function registeredSeatsFor($student): int
    {
        $query = StudentEventRegistration::where('event_schedule_id', $this->id);

        if ($this->isCommonFirstYearSchedule($student)) {
            return $query->whereHas('student', function ($q) use ($student) {
                $q->whereIn('semester', ['1', '2']);
                if (!empty($student->batch)) {
                    $q->where('batch', $student->batch);
                }
            })->count();
        }

        return $query->whereHas('student', function ($q) use ($student) {
            $q->where('programme_id', $student->programme_id)
                ->where('section', $student->section)
                ->where('batch', $student->batch)
                ->where('semester', $student->semester);
        })->count();
    }
}
