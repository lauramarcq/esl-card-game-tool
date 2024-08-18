<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Game;
use App\Models\GameList;
use App\Models\ListItem;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Builder', [
            'categoryOptions' => Category::paginate(20),
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $gameOptions = $request->validated();
            Category::create($gameOptions);

            return Redirect::route('builder')->with('success', 'Game options created successfully');
        } catch (\Exception $e) {
            Log::error('Error in SubjectController@create: ' . $e->getMessage());
            throw $e;
        }
    }

    public function update(StoreCategoryRequest $request, $gameId)
    {
        try {
            $game = Category::find($gameId);
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

    public function destroy($id)
    {
        try {
            $gameListId = GameList::where('category_id', $id)->pluck('id');
            ListItem::whereIn('game_list_id', $gameListId)->delete();
            GameList::where('category_id', $id)->delete();
            Category::find($id)->delete();
        } catch (\Exception $e) {
            Log::error('Error in GameOptionsController@destroy: ' . $e->getMessage());
            throw $e;
        }
    }
}
