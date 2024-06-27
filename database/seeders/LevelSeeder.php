<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::factory()->create([
            'level' => 'A1',
            'description' => 'Beginner',
        ]);

        Level::factory()->create([
            'level' => 'A2',
            'description' => 'Elementary',
        ]);

        Level::factory()->create([
            'level' => 'B1',
            'description' => 'Intermediate',
        ]);

        Level::factory()->create([
            'level' => 'B2',
            'description' => 'Upper Intermediate',
        ]);

        Level::factory()->create([
            'level' => 'C1',
            'description' => 'Advanced',
        ]);

        Level::factory()->create([
            'level' => 'C2',
            'description' => 'Proficient',
        ]);
    }
}
