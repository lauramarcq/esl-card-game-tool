<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Level;

class GameList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level_id',
        'category_id',
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function level()
    {
        return $this->hasOne(Level::class);
    }

    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
