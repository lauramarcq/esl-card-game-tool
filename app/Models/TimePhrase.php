<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Level;

class TimePhrase extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_phrase',
        'is_past',
        'is_present',
        'is_future',
        'is_simple',
        'is_continuous',
        'is_perfect',
        'is_perfect_continuous',
    ];

    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }

    public function getIsPastAttribute($value): bool
    {
        return (bool) $value;
    }

    public function getIsPresentAttribute($value): bool
    {
        return (bool) $value;
    }

    public function getIsFutureAttribute($value): bool
    {
        return (bool) $value;
    }

    public function getIsSimpleAttribute($value): bool
    {
        return (bool) $value;
    }

    public function getIsContinuousAttribute($value): bool
    {
        return (bool) $value;
    }

    public function getIsPerfectAttribute($value): bool
    {
        return (bool) $value;
    }

    public function getIsPerfectContinuousAttribute($value): bool
    {
        return (bool) $value;
    }
}
