<?php

namespace Database\Seeders\ListItemSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListItem;
use App\Models\GameList;
use App\Models\Level;

class PredicatesA1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $noVerbValues = [
            'on the table', 'next to the child', 'in the box', 'under the tree', 'near the house', 'around the city', 'at the beach', 'in the chair', 'beside the window', 'above the shelf', 'on the street', 'in the room', 'red', 'green', 'blue', 'yellow', 'brown', 'white', 'black', 'purple', 'pink', 'orange', 'happy', 'sad', 'big', 'small', 'tall', 'short', 'old', 'new', 'fast', 'slow', 'heavy', 'light', 'hot', 'cold', 'loud', 'quiet', 'clean', 'dirty', 'soft', 'hard'
        ];

        $verbValues = [];

        $levelA1 = Level::where('level', 'A1')->first();

        $noVerbList = GameList::where('name', 'No Verb')->where('level_id', $levelA1->id)->first();

        $verbList = GameList::where('name', 'Verb')->where('level_id', $levelA1->id)->first();



        foreach ($noVerbValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $noVerbList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($verbValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $verbList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }
    }
}
