<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Noun;

class NounSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Noun::factory()->create([
            'noun' => 'apple',
            'is_plural' => false,
            'is_irregular' => false,
            'ends_in_y' => false,
            'ends_in_s_sh_ch' => false,
            'ends_in_f' => false,
            'begins_with_vowel_sound' => true,
        ]);
        Noun::factory()->create([
            'noun' => 'child',
            'is_plural' => false,
            'is_irregular' => true,
            'ends_in_y' => false,
            'ends_in_s_sh_ch' => false,
            'ends_in_f' => false,
            'begins_with_vowel_sound' => false,
        ]);

        Noun::factory()->create([
            'noun' => 'country',
            'is_plural' => false,
            'is_irregular' => false,
            'ends_in_y' => true,
            'ends_in_s_sh_ch' => false,
            'ends_in_f' => false,
            'begins_with_vowel_sound' => false,
        ]);
        
        Noun::factory()->create([
            'noun' => 'box',
            'is_plural' => false,
            'is_irregular' => false,
            'ends_in_y' => false,
            'ends_in_s_sh_ch' => true,
            'ends_in_f' => false,
            'begins_with_vowel_sound' => false,
        ]);

        Noun::factory()->create([
            'noun' => 'leaf',
            'is_plural' => false,
            'is_irregular' => false,
            'ends_in_y' => false,
            'ends_in_s_sh_ch' => true,
            'ends_in_f' => true,
            'begins_with_vowel_sound' => false,
        ]);
    }
}
