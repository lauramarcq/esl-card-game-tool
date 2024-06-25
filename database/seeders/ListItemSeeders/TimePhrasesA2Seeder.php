<?php

namespace Database\Seeders\ListItemSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListItem;
use App\Models\GameList;
use App\Models\Level;

class TimePhrasesA2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $presentSimpleValues = [
            'every day', 'every week', 'every month', 'every year', 'always', 'usually', 'often', 'in general', 'regularly', 'occasionally', 'sometimes', 'rarely', 'hardly ever', 'never', 'on Mondays', 'on Tuesdays', 'on Wednesdays', 'on Thursdays', 'on Fridays', 'on Saturdays', 'on Sundays', 'on weekends', 'on weekdays', 'in the morning', 'in the afternoon', 'in the evening', 'at night', 'every morning', 'every afternoon', 'every evening', 'every night', 'once a day', 'twice a day', 'three times a day', 'four times a day', 'five times a day', 'once a week', 'twice a week', 'three times a week', 'four times a week', 'five times a week', 'once a month', 'twice a month', 'three times a month', 'four times a month', 'five times a month', 'once a year', 'twice a year', 'three times a year', 'four times a year', 'five times a year', 'every January', 'every February', 'every March', 'every April', 'every May', 'every June', 'every July', 'every August', 'every September', 'every October', 'every November', 'every December'
        ];

        $presentContinuousValues = [
            'at the moment', 'now', 'tonight', 'today', 'this week', 'this month', 'this year'
        ];

        $pastSimpleValues = [
            'yesterday', 'last Monday', 'last Tuesday', 'last Wednesday', 'last Thursday', 'last Friday', 'last Saturday', 'last Sunday', 'last weekend', 'last week', 'last month', 'last January', 'last February', 'last March', 'last April', 'last May', 'last June', 'last July', 'last August', 'last September', 'last October', 'last November', 'last December', 'last year', 'one hour ago', 'two hours ago', 'three hours ago', 'three days ago', 'five days ago', 'a week ago', 'two weeks ago', 'three weeks ago', 'a month ago', 'two months ago', 'three months ago', 'six months ago', 'nine months ago', 'a year ago', 'two years ago', 'three years ago', 'four years ago', 'five years ago', 'six years ago', 'seven years ago', 'eight years ago', 'nine years ago', 'ten years ago', '11 years ago', '12 years ago', '13 years ago', '14 years ago', '15 years ago', '16 years ago', '17 years ago', '18 years ago', '19 years ago', '20 years ago', '21 years ago', '22 years ago', '23 years ago', '24 years ago', '25 years ago', '26 years ago', '27 years ago', '28 years ago', '29 years ago', '30 years ago'
        ];

        $presentPerfectValues = ['recently', 'just', 'yet', 'already', 'for a day', 'for two weeks', 'for three months', 'for four years', 'for a decade', 'for a long time', 'for a short while', 'for ages', 'for the past hour', 'for most of my life', 'since yesterday', 'since last week', 'since last month', 'since last year', 'since I was a child', 'since I moved here', 'since the 1990s', 'since January'];

        $futureValues = ['tomorrow', 'next Monday', 'next Tuesday', 'next Wednesday', 'next Thursday', 'next Friday', 'next Saturday', 'next Sunday', 'next January', 'next February', 'next March', 'next April', 'next May', 'next June', 'next July', 'next August', 'next September', 'next October', 'next November', 'next December', 'next week', 'next month', 'next year', 'in ten days', 'in a week', 'in a month', 'in a year', 'in two weeks', 'in two months', 'in two years', 'in three days', 'in three weeks', 'in three months', 'in three years', 'in six weeks', 'in six months', 'in six years', 'soon', 'later'];


        $levelA2 = Level::where('level', 'A2')->first();

        $presentSimpleList = GameList::where('name', 'Present Simple')->where('level_id', $levelA2->id)->first();

        $presentContinuousList = GameList::where('name', 'Present Continuous')->where('level_id', $levelA2->id)->first();

        $pastSimpleList = GameList::where('name', 'Past Simple')->where('level_id', $levelA2->id)->first();

        $presentPerfectList = GameList::where('name', 'Present Perfect')->where('level_id', $levelA2->id)->first();

        $futureList = GameList::where('name', 'Future')->where('level_id', $levelA2->id)->first();


        foreach ($pastSimpleValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $presentSimpleList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($presentContinuousValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $presentContinuousList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($pastSimpleValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $pastSimpleList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($presentPerfectValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $presentPerfectList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($futureValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $futureList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }
    }
}
