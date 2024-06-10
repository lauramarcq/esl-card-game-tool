<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::factory()->create([
            'subject' => 'an apple',
            'is_plural' => false,
            'begins_with_article_a' => false,
            'begins_with_article_an' => true,
            'begins_with_article_the' => false,
        ]);
        Subject::factory()->create([
            'subject' => 'the apples',
            'is_plural' => true,
            'begins_with_article_a' => false,
            'begins_with_article_an' => false,
            'begins_with_article_the' => true,
        ]);
    }
}
