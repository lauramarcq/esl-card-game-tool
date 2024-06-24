<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Level;
use App\Models\Category;
use App\Models\GameList;
use App\Models\Game;

class DashboardController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Dashboard', [
            'levels' => Level::all(),
            'categories' => Category::all(),
            'gameLists' => GameList::all(),
            'games' => Game::all(),
        ]);
    }
}
