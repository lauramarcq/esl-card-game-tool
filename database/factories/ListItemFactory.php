<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ListItem;
use App\Models\GameList;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ListItem>
 */
class ListItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'list_id' => GameList::factory(),
            'item_value' => $this->faker->word(),
            'plural' => $this->faker->word(),
        ];
    }
}
