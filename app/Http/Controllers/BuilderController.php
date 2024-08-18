<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Game;
use App\Models\Category;
use App\Models\GameList;
use App\Models\ListItem;
use App\Models\Level;

class BuilderController extends Controller
{
    public function index()
    {
        return Inertia::render('Builder', [
            'gameOptions' => Game::paginate(20),
            'categoryOptions' => Category::paginate(20),
            'listOptions'  => GameList::paginate(20),
            'listItems' => ListItem::paginate(20),
            'levels' => Level::all()
        ]);
    }
}
