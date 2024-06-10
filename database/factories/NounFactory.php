<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Noun>
 */
class NounFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'noun' => $this->faker->word(),
            'is_plural' => $this->faker->boolean(),
            'is_irregular' => $this->faker->boolean(),
            'ends_in_y' => $this->faker->boolean(),
            'ends_in_s_sh_ch' => $this->faker->boolean(),
            'ends_in_f' => $this->faker->boolean(),
            'begins_with_vowel_sound' => $this->faker->boolean(),
            'begins_with_consonant_sound' => $this->faker->boolean(),
        ];
    }
}
