<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\GameSettings;
use App\Models\Game;
use App\Models\Level;
use App\Models\Category;
use App\Models\GameList;
use App\Models\ListItem;

class GameController extends Controller
{
    /**
     * Get all data for game setup from latest created record.
     */
    public function get(Request $request)

    {
        $gameSettings = GameSettings::with([
            'game',
            'level',
            'deck1List',
            'deck2List',
            'deck3List',
            'deck1Category',
            'deck2Category',
            'deck3Category',
        ])->latest()->first();

        return Inertia::render('MainStage', [
            'gameType' => $gameSettings->game,
            'level' => $gameSettings->level,
            'cardDecks' => $gameSettings->card_decks,
            'cardDeck1List' => $gameSettings->deck1List,
            'cardDeck2List' => $gameSettings->deck2List,
            'cardDeck3List' => $gameSettings->deck3List,
            'cardDeck1Category' => $gameSettings->deck1Category,
            'cardDeck2Category' => $gameSettings->deck2Category,
            'cardDeck3Category' => $gameSettings->deck3Category,
        ]);
    }
}
