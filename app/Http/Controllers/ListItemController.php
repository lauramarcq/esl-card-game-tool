<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\GameList;
use App\Models\ListItem;
use App\Models\Level;
use App\Http\Requests\StoreListItemRequest;
use App\Http\Requests\EditListItemRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ListItemController extends Controller
{
    public function get($id)
    {
        return Inertia::render('Builder', [
            'listItems' => ListItem::where('game_list_id', $id)->paginate(5),
            'listOptions'  => GameList::all(),
            'levels' => Level::all(),
        ]);
    }

    public function store(StoreListItemRequest $request)
    {
        try {
            $options = $request->validated();
            ListItem::where('game_list_id', $options['game_list_id'])->create($options);

            // return Redirect::route('builder/list')->with('success', 'Game options created successfully');
        } catch (\Exception $e) {
            Log::error('Error in ListItemController@store: ' . $e->getMessage());
            throw $e;
        }
    }

    public function update(EditListItemRequest $request, $id)
    {
        try {
            $item = ListItem::find($id);
            if (!$item) {
                return Redirect::route('builder.list.item.get', ['id' => $request['game_list_id']])->with('error', 'Item not found');
            }
            $item->item_value = $request->input('item_value');
            if ($request->input('plural')) {
                $item->plural = $request->input('plural');
            }
            $item->save();
            return redirect()->route('builder.list.item.get', ['id' => $request['game_list_id']])->with('success', 'Item updated successfully');
        } catch (\Exception $e) {
            Log::error('Error in ListItemController@update: ' . $e->getMessage());
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            ListItem::find($id)->delete();
        } catch (\Exception $e) {
            Log::error('Error in ListItemController@destroy: ' . $e->getMessage());
            throw $e;
        }
    }
}
