<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameList;
use App\Models\GameSettings;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function wordList()
    {
        return $this->hasMany(GameList::class);
    }

    public function gameSettings()
    {
        return $this->hasMany(GameSettings::class);
    }
}
