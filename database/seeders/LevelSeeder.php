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
            'code' => 'A1',
            'level' => 'Beginner',
        ]);

        Level::factory()->create([
            'code' => 'A2',
            'level' => 'Elementary',
        ]);

        Level::factory()->create([
            'code' => 'B1',
            'level' => 'Intermediate',
        ]);

        Level::factory()->create([
            'code' => 'B2',
            'level' => 'Upper Intermediate',
        ]);

        Level::factory()->create([
            'code' => 'C1',
            'level' => 'Advanced',
        ]);

        Level::factory()->create([
            'code' => 'C2',
            'level' => 'Proficient',
        ]);
    }
}
