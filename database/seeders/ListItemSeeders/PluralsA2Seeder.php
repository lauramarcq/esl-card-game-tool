<?php

namespace Database\Seeders\ListItemSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListItem;
use App\Models\GameList;
use App\Models\Level;

class PluralsA2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regularNounsValues = ['a table', 'a tree', 'a house', 'a cat', 'a window', 'a chair', 'a pen', 'an apple', 'a star', 'a flower', 'a computer', 'a friend', 'a phone', 'a room', 'a street', 'a book', 'a car', 'a dog'];

        $irregularNounsValues = ['a child', 'a foot', 'a goose', 'a man', 'a tooth', 'a woman', 'a mouse', 'a person', 'a deer', 'a fish', 'a sheep'];

        $endingWithY = ['a toy', 'a key', 'a boy', 'a baby', 'a city', 'a lady', 'a country', 'a party', 'a story', 'a family', 'a journey', 'a monkey', 'a valley', 'a library', 'a factory'];

        $endingWithSSHCH = ['a box', 'a bush', 'a dish', 'a fox', 'a beach', 'a dish', 'a bus', 'a brush', 'a church', 'a bench', 'a branch', 'a match', 'a watch', 'a witch', 'a peach', 'a coach'];

        $endingWithF = ['a leaf', 'a life', 'a wolf', 'a half', 'a shelf', 'a knife', 'a wife', 'a loaf', 'a thief', 'a calf', 'a dwarf', 'a scarf', 'a chief', 'a roof', 'a belief', 'a proof'];

        $endingWithO = ['a hero', 'a potato', 'a tomato', 'a volcano', 'a kangaroo', 'a zoo', 'a photo', 'a radio'];

        $levelA2 = Level::where('level', 'A2')->first();

        $regularNounsList = GameList::where('name', 'Regular Nouns')->where('level_id', $levelA2->id)->first();

        $irregularNounsList = GameList::where('name', 'Irregular Nouns')->where('level_id', $levelA2->id)->first();

        $endingWithYList = GameList::where('name', 'Ending with -y')->where('level_id', $levelA2->id)->first();

        $endingWithSSHCHList = GameList::where('name', 'Ending with -s, -ss, -sh, -ch, -x')->where('level_id', $levelA2->id)->first();

        $endingWithFList = GameList::where('name', 'Ending with -f')->where('level_id', $levelA2->id)->first();

        $endingWithOList = GameList::where('name', 'Ending with -o')->where('level_id', $levelA2->id)->first();

        foreach ($regularNounsValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $regularNounsList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($irregularNounsValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $irregularNounsList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($endingWithY as $value) {
            ListItem::factory()->create([
                'game_list_id' => $endingWithYList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($endingWithSSHCH as $value) {
            ListItem::factory()->create([
                'game_list_id' => $endingWithSSHCHList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($endingWithF as $value) {
            ListItem::factory()->create([
                'game_list_id' => $endingWithFList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($endingWithO as $value) {
            ListItem::factory()->create([
                'game_list_id' => $endingWithOList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }
    }
}
