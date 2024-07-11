<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\GameList;
use App\Models\ListItem;
use App\Models\Level;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ListController extends Controller
{
    public function index()
    {
        return Inertia::render('Builder', [
            'categoryOptions' => Category::all(),
            'listOptions'  => GameList::paginate(5),
            // 'listItems' => ListItem::paginate(5),
            'levels' => Level::all()
        ]);
    }

    // public function store(StoreCategoryRequest $request)
    // {
    //     try {
    //         $gameOptions = $request->validated();
    //         Category::create($gameOptions);

    //         return Redirect::route('builder')->with('success', 'Game options created successfully');
    //     } catch (\Exception $e) {
    //         Log::error('Error in SubjectController@create: ' . $e->getMessage());
    //         throw $e;
    //     }
    // }

    // public function update(StoreCategoryRequest $request, $gameId)
    // {
    //     try {
    //         $game = Category::find($gameId);
    //         if (!$game) {
    //             return Redirect::route('builder')->with('error', 'Game not found');
    //         }
    //         $game->update($request->all());
    //         return redirect()->route('builder');
    //     } catch (\Exception $e) {
    //         Log::error('Error in GameOptionsController@update: ' . $e->getMessage());
    //         throw $e;
    //     }
    // }

    // public function destroy($gameId)
    // {
    //     try {
    //         Category::find($gameId)->delete();
    //     } catch (\Exception $e) {
    //         Log::error('Error in GameOptionsController@destroy: ' . $e->getMessage());
    //         throw $e;
    //     }
    // }
}
