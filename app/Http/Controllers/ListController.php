<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\GameList;
use App\Models\ListItem;
use App\Models\Level;
use App\Http\Requests\StoreListRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Termwind\Components\Li;

class ListController extends Controller
{
    public function index()
    {
        return Inertia::render('Builder', [
            'categoryOptions' => Category::all(),
            'listOptions'  => GameList::paginate(5),
            'levels' => Level::all()
        ]);
    }

    public function get($id)
    {
        return Inertia::render('Builder', [
            'listItems' => ListItem::where('game_list_id', $id)->paginate(5),
            'listOptions'  => GameList::all(),
        ]);
    }

    public function store(StoreListRequest $request)
    {
        try {
            $options = $request->validated();
            GameList::create($options);

            return Redirect::route('builder/list')->with('success', 'Game options created successfully');
        } catch (\Exception $e) {
            Log::error('Error in ListController@create: ' . $e->getMessage());
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            GameList::find($id)->delete();
            ListItem::where('game_list_id', $id)->delete();
        } catch (\Exception $e) {
            Log::error('Error in GameOptionsController@destroy: ' . $e->getMessage());
            throw $e;
        }
    }
}
