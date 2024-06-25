<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Level;
use App\Models\ListItem;
use App\Models\GameSettings;

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

    public function listItems()
    {
        return $this->hasMany(ListItem::class);
    }

    public function gameSettings()
    {
        return $this->hasMany(GameSettings::class);
    }
}
