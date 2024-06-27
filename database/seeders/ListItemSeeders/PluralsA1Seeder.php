<?php

namespace Database\Seeders\ListItemSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListItem;
use App\Models\GameList;
use App\Models\Level;

class PluralsA1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regularNounsValues = ['a table', 'a tree', 'a house', 'a cat', 'a window', 'a chair', 'a pen', 'an apple', 'a star', 'a flower', 'a computer', 'a friend', 'a phone', 'a room', 'a street', 'a book', 'a car', 'a dog'];

        $irregularNounsValues = ['a child', 'a foot', 'a goose', 'a man', 'a tooth', 'a woman', 'a mouse', 'a person', 'a deer', 'a fish', 'a sheep'];

        $endingWithY = ['a toy', 'a key', 'a boy', 'a baby', 'a city', 'a lady', 'a country', 'a party'];

        $endingWithSSHCH = ['a box', 'a bush', 'a dish', 'a fox', 'a beach', 'a dish', 'a bus'];

        $endingWithF = ['a leaf', 'a life', 'a wolf', 'a half', 'a shelf', 'a knife', 'a wife'];

        $levelA1 = Level::where('level', 'A1')->first();

        $regularNounsList = GameList::where('name', 'Regular Nouns')->where('level_id', $levelA1->id)->first();

        $irregularNounsList = GameList::where('name', 'Irregular Nouns')->where('level_id', $levelA1->id)->first();

        $endingWithYList = GameList::where('name', 'Ending with -y')->where('level_id', $levelA1->id)->first();

        $endingWithSSHCHList = GameList::where('name', 'Ending with -s, -ss, -sh, -ch, -x')->where('level_id', $levelA1->id)->first();

        $endingWithFList = GameList::where('name', 'Ending with -f')->where('level_id', $levelA1->id)->first();

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
    }
}
