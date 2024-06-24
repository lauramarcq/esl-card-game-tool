<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameList;

class ListItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'list_id',
        'item_value',
        'plural',
    ];

    public function wordsList()
    {
        return $this->belongsTo(GameList::class);
    }
}
