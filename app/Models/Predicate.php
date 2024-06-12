<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Level;

class Predicate extends Model
{
    use HasFactory;

    protected $fillable = [
        'predicate',
        'is_phrase',
    ];

    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }
}
