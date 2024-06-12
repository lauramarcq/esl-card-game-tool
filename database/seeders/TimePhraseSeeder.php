<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TimePhrase;

class TimePhraseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TimePhrase::factory()->create([
            'time_phrase' => 'yesterday',
            'is_past' => true,
            'is_present' => false,
            'is_future' => false,
            'is_continuous' => true,
            'is_perfect' => true,
            'is_perfect_continuous' => true,
        ]);
        TimePhrase::factory()->create([
            'time_phrase' => 'today',
            'is_past' => false,
            'is_present' => true,
            'is_future' => false,
            'is_continuous' => true,
            'is_perfect' => true,
            'is_perfect_continuous' => true,
        ]);
        TimePhrase::factory()->create([
            'time_phrase' => 'tomorrow',
            'is_past' => false,
            'is_present' => false,
            'is_future' => true,
            'is_continuous' => true,
            'is_perfect' => true,
            'is_perfect_continuous' => true,
        ]);
    }
}
