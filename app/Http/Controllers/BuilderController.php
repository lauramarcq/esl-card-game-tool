<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Game;
use App\Models\Category;
use App\Models\GameList;
use App\Models\ListItem;

class BuilderController extends Controller
{
    public function index()
    {
        return Inertia::render('Builder', [
            'gameOptions' => Game::paginate(5),
            'categoryOptions' => Category::paginate(5),
            'listOptions'  => GameList::paginate(5),
            'listItems' => ListItem::paginate(5)
        ]);
    }
}
