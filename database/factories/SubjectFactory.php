<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => $this->faker->sentence(),
            'is_plural' => $this->faker->boolean(),
            'begins_with_article_a' => $this->faker->boolean(),
            'begins_with_article_an' => $this->faker->boolean(),
            'begins_with_article_the' => $this->faker->boolean(),
            'is_people' => $this->faker->boolean(),
            'is_animal' => $this->faker->boolean(),
            'is_place' => $this->faker->boolean(),
            'is_thing' => $this->faker->boolean(),
        ];
    }
}
