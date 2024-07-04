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

            // convert to boolean
            $gameSettingsBoolTimer = $gameSettings['showTimer'] === true ? 1 : 0;

            $gameSettingsBoolDice = $gameSettings['showDice'] === true ? 1 : 0;

            $gameSettingsInstance = GameSettings::create([
                'game_id' => $gameSettings['gameType']['id'],
                'level_id' => $gameSettings['level']['id'],
                'card_decks' => $gameSettings['selectedNumberOfDecks'],
                'card_quantity' => $gameSettings['cardQuantity'],
                'show_timer' => $gameSettingsBoolTimer,
                'show_dice' => $gameSettingsBoolDice,
                'deck_1_category_id' => $gameSettings['cardDeck1']['category']['id'],
                'deck_2_category_id' => $gameSettings['cardDeck2']['category']['id'] ?? null,
                'deck_3_category_id' => $gameSettings['cardDeck3']['category']['id'] ?? null,
            ]);

            foreach ($gameSettings['cardDeck1']['list'] as $list) {
                $gameSettingsInstance->gameLists()->attach($list['id']);
            }

            if (isset($gameSettings['cardDeck2']['category'])) {
                foreach ($gameSettings['cardDeck2']['list'] as $list) {
                    $gameSettingsInstance->gameLists()->attach($list['id']);
                }
            }

            if (isset($gameSettings['cardDeck2']['category'])) {
                foreach ($gameSettings['cardDeck3']['list'] as $list) {
                    $gameSettingsInstance->gameLists()->attach($list['id']);
                }
            }

            return Redirect::route(
                'game',
                [
                    'gameSettings' => $gameSettingsInstance->id,
                ]
            );
        } catch (\Exception $e) {
            Log::error('Error in DashboardController@store: ' . $e->getMessage());
            throw $e;
        }
    }
}
