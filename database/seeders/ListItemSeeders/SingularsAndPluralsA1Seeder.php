<?php

namespace Database\Seeders\ListItemSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListItem;
use App\Models\GameList;
use App\Models\Level;

class SingularsAndPluralsA1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regularNounsValues = [
            ['singular' => 'a table', 'plural' => 'tables'],
            ['singular' => 'a tree', 'plural' => 'trees'],
            ['singular' => 'a house', 'plural' => 'houses'],
            ['singular' => 'a cat', 'plural' => 'cats'],
            ['singular' => 'a window', 'plural' => 'windows'],
            ['singular' => 'a chair', 'plural' => 'chairs'],
            ['singular' => 'a pen', 'plural' => 'pens'],
            ['singular' => 'an apple', 'plural' => 'apples'],
            ['singular' => 'a star', 'plural' => 'stars'],
            ['singular' => 'a flower', 'plural' => 'flowers'],
            ['singular' => 'a computer', 'plural' => 'computers'],
            ['singular' => 'a friend', 'plural' => 'friends'],
            ['singular' => 'a phone', 'plural' => 'phones'],
            ['singular' => 'a room', 'plural' => 'rooms'],
            ['singular' => 'a street', 'plural' => 'streets'],
            ['singular' => 'a book', 'plural' => 'books'],
            ['singular' => 'a car', 'plural' => 'cars'],
            ['singular' => 'a dog', 'plural' => 'dogs']
        ];

        $irregularNounsValues = [
            ['singular' => 'a child', 'plural' => 'children'],
            ['singular' => 'a foot', 'plural' => 'feet'],
            ['singular' => 'a goose', 'plural' => 'geese'],
            ['singular' => 'a man', 'plural' => 'men'],
            ['singular' => 'a tooth', 'plural' => 'teeth'],
            ['singular' => 'a woman', 'plural' => 'women'],
            ['singular' => 'a mouse', 'plural' => 'mice'],
            ['singular' => 'a person', 'plural' => 'people'],
            ['singular' => 'a deer', 'plural' => 'deer'],
            ['singular' => 'a fish', 'plural' => 'fish'],
            ['singular' => 'a ship', 'plural' => 'sheep']
        ];

        $endingWithY = [
            ['singular' => 'a toy', 'plural' => 'toys'],
            ['singular' => 'a key', 'plural' => 'keys'],
            ['singular' => 'a boy', 'plural' => 'boys'],
            ['singular' => 'a baby', 'plural' => 'babies'],
            ['singular' => 'a city', 'plural' => 'cities'],
            ['singular' => 'a lady', 'plural' => 'ladies'],
            ['singular' => 'a country', 'plural' => 'countries'],
            ['singular' => 'a party', 'plural' => 'parties']
        ];

        $endingWithSSHCH = [
            ['singular' => 'a box', 'plural' => 'boxes'],
            ['singular' => 'a bush', 'plural' => 'bushes'],
            ['singular' => 'a dish', 'plural' => 'dishes'],
            ['singular' => 'a fox', 'plural' => 'foxes'],
            ['singular' => 'a beach', 'plural' => 'beaches'],
            ['singular' => 'a bus', 'plural' => 'buses']
        ];

        $endingWithF = [
            ['singular' => 'a leaf', 'plural' => 'leaves'],
            ['singular' => 'a life', 'plural' => 'lives'],
            ['singular' => 'a wolf', 'plural' => 'wolves'],
            ['singular' => 'a half', 'plural' => 'halves'],
            ['singular' => 'a shelf', 'plural' => 'shelves'],
            ['singular' => 'a knife', 'plural' => 'knives'],
            ['singular' => 'a wife', 'plural' => 'wives']
        ];

        $levelA1 = Level::where('level', 'A1')->first();
        $singularsAndPluralsCategory = 6;

        $regularNounsList = GameList::where('name', 'Regular Nouns')->where('level_id', $levelA1->id)->where('category_id', $singularsAndPluralsCategory)->first();

        $irregularNounsList = GameList::where('name', 'Irregular Nouns')->where('level_id', $levelA1->id)->where('category_id', $singularsAndPluralsCategory)->first();

        $endingWithYList = GameList::where('name', 'Ending with -y')->where('level_id', $levelA1->id)->where('category_id', $singularsAndPluralsCategory)->first();

        $endingWithSSHCHList = GameList::where('name', 'Ending with -s, -ss, -sh, -ch, -x')->where('level_id', $levelA1->id)->where('category_id', $singularsAndPluralsCategory)->first();

        $endingWithFList = GameList::where('name', 'Ending with -f')->where('level_id', $levelA1->id)->where('category_id', $singularsAndPluralsCategory)->first();

        foreach ($regularNounsValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $regularNounsList->id,
                'item_value' => $value['singular'],
                'plural' => $value['plural'],
            ]);
        }

        foreach ($irregularNounsValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $irregularNounsList->id,
                'item_value' => $value['singular'],
                'plural' => $value['plural'],
            ]);
        }

        foreach ($endingWithY as $value) {
            ListItem::factory()->create([
                'game_list_id' => $endingWithYList->id,
                'item_value' => $value['singular'],
                'plural' => $value['plural'],
            ]);
        }

        foreach ($endingWithSSHCH as $value) {
            ListItem::factory()->create([
                'game_list_id' => $endingWithSSHCHList->id,
                'item_value' => $value['singular'],
                'plural' => $value['plural'],
            ]);
        }

        foreach ($endingWithF as $value) {
            ListItem::factory()->create([
                'game_list_id' => $endingWithFList->id,
                'item_value' => $value['singular'],
                'plural' => $value['plural'],
            ]);
        }
    }
}
