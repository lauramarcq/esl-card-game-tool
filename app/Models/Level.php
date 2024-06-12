<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use App\Models\Predicate;
use App\Models\TimePhrase;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'level',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function predicates()
    {
        return $this->belongsToMany(Predicate::class);
    }

    public function timePhrases()
    {
        return $this->belongsToMany(TimePhrase::class);
    }
}
