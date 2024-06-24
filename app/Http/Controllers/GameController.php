<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $game = new Game;
        $game->name = $request->name;
        $game->description = $request->description;
        $game->save();

        return redirect()->route('game');
    }
}
