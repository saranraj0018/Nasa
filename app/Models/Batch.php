<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Batch extends Model
{
    protected $fillable = ['name', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Active batch names for dropdowns (memoised per request).
     */
    public static function options(): Collection
    {
        return once(fn () => static::active()->orderBy('name')->pluck('name'));
    }
}
