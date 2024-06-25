<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GameList;
use App\Models\Category;
use App\Models\Level;

class GameListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Seeding Subjects Lists

        GameList::factory()->create([
            'name' => 'Pronouns',
            'category_id' => Category::where('name', 'Subjects')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Pronouns',
            'category_id' => Category::where('name', 'Subjects')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Names',
            'category_id' => Category::where('name', 'Subjects')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Names',
            'category_id' => Category::where('name', 'Subjects')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Family and Social Roles',
            'category_id' => Category::where('name', 'Subjects')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Family and Social Roles',
            'category_id' => Category::where('name', 'Subjects')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Jobs and Professions',
            'category_id' => Category::where('name', 'Subjects')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Jobs and Professions',
            'category_id' => Category::where('name', 'Subjects')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Surprising',
            'category_id' => Category::where('name', 'Subjects')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Surprising',
            'category_id' => Category::where('name', 'Subjects')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Miscellaneous All Sorts',
            'category_id' => Category::where('name', 'Subjects')->first()->id,
            'level_id' => Level::where('level', 'B1')->first()->id,
        ]);

        // Seeding Predicates

        GameList::factory()->create([
            'name' => 'Verb',
            'category_id' => Category::where('name', 'Predicates')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'No Verb',
            'category_id' => Category::where('name', 'Predicates')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Verb',
            'category_id' => Category::where('name', 'Predicates')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'No Verb',
            'category_id' => Category::where('name', 'Predicates')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);


        // Seeeding Time Phrases

        GameList::factory()->create([
            'name' => 'Present Simple',
            'category_id' => Category::where('name', 'Time Phrases')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Present Continuous',
            'category_id' => Category::where('name', 'Time Phrases')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Past Simple',
            'category_id' => Category::where('name', 'Time Phrases')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        // A2 Level Time Phrases

        GameList::factory()->create([
            'name' => 'Present Simple',
            'category_id' => Category::where('name', 'Time Phrases')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Present Continuous',
            'category_id' => Category::where('name', 'Time Phrases')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Past Simple',
            'category_id' => Category::where('name', 'Time Phrases')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Present Perfect',
            'category_id' => Category::where('name', 'Time Phrases')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Future',
            'category_id' => Category::where('name', 'Time Phrases')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        // B1 Level Time Phrases

        GameList::factory()->create([
            'name' => 'Present Simple',
            'category_id' => Category::where('name', 'Time Phrases')->first()->id,
            'level_id' => Level::where('level', 'B1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Present Continuous',
            'category_id' => Category::where('name', 'Time Phrases')->first()->id,
            'level_id' => Level::where('level', 'B1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Past Simple',
            'category_id' => Category::where('name', 'Time Phrases')->first()->id,
            'level_id' => Level::where('level', 'B1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Present Perfect',
            'category_id' => Category::where('name', 'Time Phrases')->first()->id,
            'level_id' => Level::where('level', 'B1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Future',
            'category_id' => Category::where('name', 'Time Phrases')->first()->id,
            'level_id' => Level::where('level', 'B1')->first()->id,
        ]);

        // Seeding Adjectives

        // Seeding Plurals

        GameList::factory()->create([
            'name' => 'Regular Nouns',
            'category_id' => Category::where('name', 'Plurals')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Irregular Nouns',
            'category_id' => Category::where('name', 'Plurals')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Ending with -y',
            'category_id' => Category::where('name', 'Plurals')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Ending with -s, -ss, -sh, -ch, -x',
            'category_id' => Category::where('name', 'Plurals')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Ending with -f',
            'category_id' => Category::where('name', 'Plurals')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        // Level A2 Plurals

        GameList::factory()->create([
            'name' => 'Regular Nouns',
            'category_id' => Category::where('name', 'Plurals')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Irregular Nouns',
            'category_id' => Category::where('name', 'Plurals')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Ending with -y',
            'category_id' => Category::where('name', 'Plurals')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Ending with -s, -ss, -sh, -ch, -x',
            'category_id' => Category::where('name', 'Plurals')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Ending with -f',
            'category_id' => Category::where('name', 'Plurals')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Ending with -o',
            'category_id' => Category::where('name', 'Plurals')->first()->id,
            'level_id' => Level::where('level', 'A2')->first()->id,
        ]);

        // Seeding Singulars and Plurals

        GameList::factory()->create([
            'name' => 'Regular Nouns',
            'category_id' => Category::where('name', 'Singulars and Plurals')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Irregular Nouns',
            'category_id' => Category::where('name', 'Singulars and Plurals')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Ending with -y',
            'category_id' => Category::where('name', 'Singulars and Plurals')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Ending with -s, -ss, -sh, -ch, -x',
            'category_id' => Category::where('name', 'Singulars and Plurals')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);

        GameList::factory()->create([
            'name' => 'Ending with -f',
            'category_id' => Category::where('name', 'Singulars and Plurals')->first()->id,
            'level_id' => Level::where('level', 'A1')->first()->id,
        ]);
    }
}
