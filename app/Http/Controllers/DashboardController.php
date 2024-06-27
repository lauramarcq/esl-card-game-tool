<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Level;
use App\Models\Category;
use App\Models\GameList;
use App\Models\Game;
use App\Http\Requests\StoreGameSettingsRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\GameSettings;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Get all data for dropdowns of the resource.
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

    /**
     * Store game settings.
     */
    public function store(StoreGameSettingsRequest $request): RedirectResponse
    {
        try {
            $gameSettings = $request->validated();

            $gameSettingsInstance = GameSettings::create([
                'game_id' => $gameSettings['gameType']['id'],
                'level_id' => $gameSettings['level']['id'],
                'card_decks' => $gameSettings['selectedNumberOfDecks'],
                'deck_1_category_id' => $gameSettings['cardDeck1']['category']['id'],
                'deck_1_list_id' => $gameSettings['cardDeck1']['list']['id'],
                'deck_2_category_id' => $gameSettings['cardDeck2']['category']['id'] ?? null,
                'deck_2_list_id' => $gameSettings['cardDeck2']['list']['id'] ?? null,
                'deck_3_category_id' => $gameSettings['cardDeck3']['category']['id'] ?? null,
                'deck_3_list_id' => $gameSettings['cardDeck3']['list']['id'] ?? null,
            ]);
    
            return Redirect::route('game', 
                // [
                //     'gameType' => $gameSettingsInstance->game_id, 
                //     'level' => $gameSettingsInstance->level_id, 
                //     'cardDecks' => $gameSettingsInstance->card_decks,
                //     'cardDeck1List' => $gameSettingsInstance->deck_1_list_id, 
                //     'cardDeck2List' => $gameSettingsInstance->deck_2_list_id, 'cardDeck3List' => $gameSettingsInstance->deck_3_list_id,
                //     'cardDeck1Category' => $gameSettingsInstance->deck_1_category_id,
                //     'cardDeck2Category' => $gameSettingsInstance->deck_2_category_id,
                //     'cardDeck3Category' => $gameSettingsInstance->deck_3_category_id

                // ]
            );
            
        } catch (\Exception $e) {
            Log::error('Error in DashboardController@store: ' . $e->getMessage());
            throw $e;
        }
    }
}
