<?php

namespace Database\Seeders\ListItemSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListItem;
use App\Models\GameList;
use App\Models\Level;

class SubjectsA2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pronounValues = ['He', 'She', 'They', 'It', 'I', 'You', 'We', 'You and I'];

        $nameValues = ['John', 'Mary', 'Alice', 'Tom', 'Emma', 'David', 'Sara', 'Michael', 'Lily', 'Jack', 'Sophie', 'James', 'Olivia', 'Daniel', 'Lucas', 'Mia', 'Ethan', 'Grace', 'John and Alice', 'Tom and Emma', 'David and Sara', 'Michael and Lily', 'Jack and Sophie', 'James and Olivia', 'Daniel and Lucas', 'Mia and Ethan', 'Grace and Mary'];

        $familyValues = ['my dad', 'my mother', 'my mom', 'my father', 'my sister', 'my brother', 'my grandma', 'my grandpa', 'my aunt', 'my uncle', 'my cousin', 'my parents', 'my friend', 'my friends', 'my grandparents', 'my cousins', 'my sibling', 'my siblings', 'my mother and I', 'my father and I', 'my sister and I', 'my brother and I', 'my grandma and I', 'my grandpa and I', 'my aunt and I', 'my uncle and I', 'my cousin and I', 'my parents and I', 'my friend and I', 'my friends and I', 'my grandparents and I', 'my cousins and I', 'my sibling and I', 'my siblings and I'];

        $jobsValues = ['a teacher', 'a doctor', 'a nurse', 'a firefighter', 'a police officer', 'an engineer', 'a chef', 'a farmer', 'a pilot', 'a mechanic', 'a painter', 'a cashier', 'a librarian', 'a waiter/waitress', 'a cleaner', 'a driver', 'a gardener', 'a musician', 'a student', 'a journalist', 'a carpenter', 'a receptionist', 'a photographer', 'a plumber', 'a hairdresser', 'a secretary', 'a shopassistant', 'a builder', 'a veterinarian', 'a dancer'];

        $surprisingValues = ['three grandmas', 'five cows', 'two robots', 'four kittens', 'seven ducks', 'three superheroes', 'six pirates', 'two astronauts', 'four ninjas', 'five mermaids', 'an alien', 'a dinosaur', 'a wizard', 'a talking dog', 'a magician', 'a dancing robot', 'a talking tree', 'a singing parrot', 'two zombie friends', 'a giant teddy bear', 'a happy policeman', 'a busy doctor', 'a tired shop assistant', 'angry schoolteachers'];

        $levelA2 = Level::where('level', 'A2')->first();

        $pronounsList = GameList::where('name', 'Pronouns')->where('level_id', $levelA2->id)->first();

        $namesList = GameList::where('name', 'Names')->where('level_id', $levelA2->id)->first();

        $familyRolesList = GameList::where('name', 'Family and Social Roles')->where('level_id', $levelA2->id)->first();

        $jobsList = GameList::where('name', 'Jobs and Professions')->where('level_id', $levelA2->id)->first();

        $surprisingList = GameList::where('name', 'Surprising')->where('level_id', $levelA2->id)->first();

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
