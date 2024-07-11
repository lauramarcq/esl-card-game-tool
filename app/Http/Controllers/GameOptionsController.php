<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Http\Requests\StoreGameOptionsRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class GameOptionsController extends Controller
{
    public function index()
    {
        return Inertia::render('Builder', [
            'gameOptions' => Game::paginate(5),
        ]);
    }

    public function store(StoreGameOptionsRequest $request)
    {
        try {
            $gameOptions = $request->validated();
            Game::create($gameOptions);

            return Redirect::route('builder')->with('success', 'Game options created successfully');
        } catch (\Exception $e) {
            Log::error('Error in SubjectController@create: ' . $e->getMessage());
            throw $e;
        }
    }

    public function update(StoreGameOptionsRequest $request, $gameId)
    {
        try {
            $game = Game::find($gameId);
            if (!$game) {
                return Redirect::route('builder')->with('error', 'Game not found');
            }
            $game->update($request->all());
            return redirect()->route('builder');
        } catch (\Exception $e) {
            Log::error('Error in GameOptionsController@update: ' . $e->getMessage());
            throw $e;
        }
    }

    public function destroy($gameId)
    {
        try {
            Game::find($gameId)->delete();
        } catch (\Exception $e) {
            Log::error('Error in GameOptionsController@destroy: ' . $e->getMessage());
            throw $e;
        }
    }
}
