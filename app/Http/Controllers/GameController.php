<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\GameSettings;

class GameController extends Controller
{
    /**
     * Get all records of previously set up games.
     */
    public function index(Request $request)
    {
        $allGames = GameSettings::with([
            'game',
            'level',
            'deck1Category',
            'deck2Category',
            'deck3Category',
        ])->get();
        return Inertia::render('GameLists', [
            'gameList' => $allGames,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Get all data for game setup from latest created record.
     */
    public function get(Request $request)
    {
        $gameSettings = GameSettings::with([
            'game',
            'level',
            'deck1Category',
            'deck2Category',
            'deck3Category',
        ])->latest()->first();

        $gameLists1 = $gameSettings->gameLists->filter(function ($gameList) use ($gameSettings) {
            return $gameList->category_id == $gameSettings->deck1Category->id;
        });
        $listItems1 = collect();
        foreach ($gameLists1 as $list) {
            $listItems1 = $listItems1->concat($list->listItems);
        }

        if ($gameSettings->deck2Category !== null) {
            $gameLists2 = $gameSettings->gameLists->filter(function ($gameList) use ($gameSettings) {
                return $gameList->category_id == $gameSettings->deck2Category->id;
            });
            $listItems2 = collect();
            foreach ($gameLists2 as $list) {
                $listItems2 = $listItems2->concat($list->listItems);
            }
        }
        if ($gameSettings->deck3Category !== null) {
            $gameLists3 = $gameSettings->gameLists->filter(function ($gameList) use ($gameSettings) {
                return $gameList->category_id == $gameSettings->deck3Category->id;
            });
            $listItems3 = collect();
            foreach ($gameLists3 as $list) {
                $listItems3 = $listItems3->concat($list->listItems);
            }
        }


        return Inertia::render('MainStage', [
            'gameType' => $gameSettings->game,
            'level' => $gameSettings->level,
            'cardDecks' => $gameSettings->card_decks,
            'cardQuantity' => $gameSettings->card_quantity,
            'showTimer' => $gameSettings->show_timer === 1 ? true : false,
            'showDice' => $gameSettings->show_dice === 1 ? true : false,
            'cardDeck1List' => $listItems1,
            'cardDeck2List' => $listItems2 ?? null,
            'cardDeck3List' => $listItems3 ?? null,
            'cardDeck1Category' => $gameSettings->deck1Category,
            'cardDeck2Category' => $gameSettings->deck2Category,
            'cardDeck3Category' => $gameSettings->deck3Category,
        ]);
    }

    /**
     * Get all data for game setup bt id.
     */

    public function show($id)
    {
        $gameSettings = GameSettings::with([
            'game',
            'level',
            'deck1Category',
            'deck2Category',
            'deck3Category',
        ])->where('id', $id)->first();


        $gameLists1 = $gameSettings->gameLists->filter(function ($gameList) use ($gameSettings) {
            return $gameList->category_id == $gameSettings->deck1Category->id;
        });
        $listItems1 = collect();
        foreach ($gameLists1 as $list) {
            $listItems1 = $listItems1->concat($list->listItems);
        }

        if ($gameSettings->deck2Category !== null) {
            $gameLists2 = $gameSettings->gameLists->filter(function ($gameList) use ($gameSettings) {
                return $gameList->category_id == $gameSettings->deck2Category->id;
            });
            $listItems2 = collect();
            foreach ($gameLists2 as $list) {
                $listItems2 = $listItems2->concat($list->listItems);
            }
        }
        if ($gameSettings->deck3Category !== null) {
            $gameLists3 = $gameSettings->gameLists->filter(function ($gameList) use ($gameSettings) {
                return $gameList->category_id == $gameSettings->deck3Category->id;
            });
            $listItems3 = collect();
            foreach ($gameLists3 as $list) {
                $listItems3 = $listItems3->concat($list->listItems);
            }
        }

        return Inertia::render('MainStage', [
            'gameType' => $gameSettings->game,
            'level' => $gameSettings->level,
            'cardDecks' => $gameSettings->card_decks,
            'cardQuantity' => $gameSettings->card_quantity,
            'showTimer' => $gameSettings->show_timer === 1 ? true : false,
            'showDice' => $gameSettings->show_dice === 1 ? true : false,
            'cardDeck1List' => $listItems1,
            'cardDeck2List' => $listItems2 ?? null,
            'cardDeck3List' => $listItems3 ?? null,
            'cardDeck1Category' => $gameSettings->deck1Category,
            'cardDeck2Category' => $gameSettings->deck2Category,
            'cardDeck3Category' => $gameSettings->deck3Category,
        ]);
    }

    /**
     * Delete game setup by id.
     */
    public function destroy($id)
    {
        GameSettings::destroy($id);
        // return redirect()->route('game-lists');
    }
}
