<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\LevelSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\GameListSeeder;
use Database\Seeders\ListItemSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true,
            'password' => 'secret1234',
        ]);

        $this->call(LevelSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(GameListSeeder::class);
        $this->call(ListItemSeeder::class);
    }


}
