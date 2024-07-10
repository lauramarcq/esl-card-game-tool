<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Http\Requests\StoreGameOptionsRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class GameOptionsController extends Controller
{

    public function store(StoreGameOptionsRequest $request)
    {
        try {
            $gameOptions = $request->validated();
            $gameOptionsInstance = Game::create($gameOptions);

            return Redirect::route('builder')->with('success', 'Game options created successfully');
        } catch (\Exception $e) {
            Log::error('Error in SubjectController@create: ' . $e->getMessage());
            throw $e;
        }
    }

    public function update(Request $request, $gameId)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Game::find($gameId)->update($request->all());

        return redirect()->route('builder');
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
