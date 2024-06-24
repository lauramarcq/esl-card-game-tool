<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::factory()->create([
            'title' => 'Present Tenses',
            'subtitle' => 'Card Flip',
            'description' => 'Make sentences and questions by putting the verbs in the right form!',
            'example' => 'A bear sleeps all day in winter',
        ]);

        Game::factory()->create([
            'title' => 'How Do They Feel?',
            'subtitle' => 'Card Flip',
            'description' => 'How do these characters feel in these situations? Make sentences!',
            'example' => 'A scientist feels excited when they have a breakthrough',
        ]);

        Game::factory()->create([
            'title' => 'Singular and Plural',
            'subtitle' => 'Card Flip',
            'description' => 'Make sentences and questions using the correct form of the verb BE!',
            'example' => 'A woman IS at work',
        ]);
    }
}
