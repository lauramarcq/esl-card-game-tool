<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameList;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'description',
    ];

    public function WordsList()
    {
        return $this->hasMany(GameList::class);
    }
}