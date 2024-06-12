<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimePhrases>
 */
class TimePhraseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'time_phrase' => $this->faker->sentence(),
            'is_past' => $this->faker->boolean(),
            'is_present' => $this->faker->boolean(),
            'is_future' => $this->faker->boolean(),
            'is_simple' => $this->faker->boolean(),
            'is_continuous' => $this->faker->boolean(),
            'is_perfect' => $this->faker->boolean(),
            'is_perfect_continuous' => $this->faker->boolean(),
        ];
    }
}
