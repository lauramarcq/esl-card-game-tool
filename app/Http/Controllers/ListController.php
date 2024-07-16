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
use Illuminate\Support\Arr;


class ListController extends Controller
{
    public function index(Request $request)
    {
        $categories = $request->query('category') ? explode(',', $request->query('category')) : [];
        $levels = $request->query('level') ? explode(',', $request->query('level')) : [];

        $gameListQuery = GameList::query();

        if (!empty($categories)) {
            $gameListQuery->whereIn('category_id', $categories);
        }
        if (!empty($levels)) {
            $gameListQuery->whereIn('level_id', $levels);
        }

        $listOptions = $gameListQuery->paginate(5)->appends($request->all());

        return Inertia::render('Builder', [
            'categoryOptions' => Category::all(),
            'listOptions'  => $listOptions,
            'levels' => Level::all(),
            'filters' => $request->all()
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

            $extracted = ['name' => $options['name'], 'level_id' => $options['level']['id'], 'category_id' => $options['category']['id']];

            GameList::create($extracted);

            return Redirect::route('builder.list.index')->with('success', 'Game options created successfully');
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
