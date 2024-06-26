<?php

namespace Database\Seeders\ListItemSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListItem;
use App\Models\GameList;
use App\Models\Level;

class SubjectsA1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pronounValues = ['He', 'She', 'They', 'It', 'I', 'You', 'We', 'You and I'];

        $nameValues = ['John', 'Mary', 'Alice', 'Tom', 'Emma', 'David', 'Sara', 'Michael', 'Lily', 'Jack', 'Sophie', 'James', 'Olivia', 'Daniel', 'Lucas', 'Mia', 'Ethan', 'Grace', 'John and Mary', 'Alice and Tom', 'Emma and David', 'Sara and Michael', 'Lily and Jack', 'Sophie and James', 'Olivia and Daniel', 'Lucas and Mia', 'Ethan and Grace'];

        $familyValues = ['my mom', 'my mother', 'my dad', 'my father', 'my sister', 'my brother', 'my grandma', 'my grandpa', 'my aunt', 'my uncle', 'my cousin', 'my parents', 'my friend', 'my friends', 'my grandparents', 'my cousins', 'my mother and I', 'my father and I', 'my sister and I', 'my brother and I', 'my grandma and I', 'my grandpa and I', 'my aunt and I', 'my uncle and I', 'my cousin and I', 'my parents and I', 'my friend and I', 'my friends and I', 'my grandparents and I', 'my cousins and I'];

        $jobsValues = ['a teacher', 'a doctor', 'a nurse', 'a firefighter', 'a police officer', 'a chef', 'a farmer', 'a pilot', 'a mechanic', 'a painter', 'a cashier', 'a librarian', 'a waiter/waitress', 'a cleaner', 'a driver', 'a gardener', 'a musician', 'a student', 'a journalist', 'a carpenter'];

        $surprisingValues = ['three grandmas', 'five cows', 'two robots', 'a dinosaur', 'two puppies', 'four kittens', 'seven ducks', 'three superheroes', 'six pirates', 'a sad clown', 'a tired pirate', 'a sleepy kitten', 'a happy puppy', 'a dragon', 'two zombie friends'];

        $levelA1 = Level::where('level', 'A1')->first();

        $pronounsList = GameList::where('name', 'Pronouns')->where('level_id', $levelA1->id)->first();

        $namesList = GameList::where('name', 'Names')->where('level_id', $levelA1->id)->first();

        $familyRolesList = GameList::where('name', 'Family and Social Roles')->where('level_id', $levelA1->id)->first();

        $jobsList = GameList::where('name', 'Jobs and Professions')->where('level_id', $levelA1->id)->first();

        $surprisingList = GameList::where('name', 'Surprising')->where('level_id', $levelA1->id)->first();

        foreach ($pronounValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $pronounsList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($nameValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $namesList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($familyValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $familyRolesList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($jobsValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $jobsList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }

        foreach ($surprisingValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $surprisingList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }
    }
}
