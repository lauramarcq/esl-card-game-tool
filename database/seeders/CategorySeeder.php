<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->create([
            'name' => 'Subjects',
        ]);

        Category::factory()->create([
            'name' => 'Predicates',
        ]);

        Category::factory()->create([
            'name' => 'Time Phrases',
        ]);

        Category::factory()->create([
            'name' => 'Adjectives',
        ]);

        Category::factory()->create([
            'name' => 'Plurals',
        ]);

        Category::factory()->create([
            'name' => 'Singulars and Plurals',
        ]);

        Category::factory()->create([
            'name' => 'Miscellaneous',
        ]);
    }
}
