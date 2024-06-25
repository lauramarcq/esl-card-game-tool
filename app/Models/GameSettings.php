<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;
use App\Models\Level;
use App\Models\Category;
use App\Models\GameList;

class GameSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'level_id',
        'card_decks',
        'deck_1_category_id',
        'deck_2_category_id',
        'deck_3_category_id',
        'deck_1_list_id',
        'deck_2_list_id',
        'deck_3_list_id',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function deck1Category()
    {
        return $this->belongsTo(Category::class, 'deck_1_category_id');
    }

    public function deck2Category()
    {
        return $this->belongsTo(Category::class, 'deck_2_category_id');
    }

    public function deck3Category()
    {
        return $this->belongsTo(Category::class, 'deck_3_category_id');
    }

    public function deck1List()
    {
        return $this->belongsTo(GameList::class, 'deck_1_list_id');
    }

    public function deck2List()
    {
        return $this->belongsTo(GameList::class, 'deck_2_list_id');
    }

    public function deck3List()
    {
        return $this->belongsTo(GameList::class, 'deck_3_list_id');
    }
}