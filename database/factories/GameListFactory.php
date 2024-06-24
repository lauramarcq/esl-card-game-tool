<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\GameList;
use App\Models\Level;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameList>
 */
class GameListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();
        $level = Level::inRandomOrder()->first();

        return [
            'name' => $this->faker->word(),
            'level_id' => $level->id,
            'category_id' => $category->id,
        ];
    }
}
