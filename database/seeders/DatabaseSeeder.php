<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\LevelSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\GameListSeeder;
use Database\Seeders\ListItemSeeders\PluralsA1Seeder;
use Database\Seeders\ListItemSeeders\PluralsA2Seeder;
use Database\Seeders\ListItemSeeders\PredicatesA1Seeder;
use Database\Seeders\ListItemSeeders\PredicatesA2Seeder;
use Database\Seeders\ListItemSeeders\SingularsAndPluralsA1Seeder;
use Database\Seeders\ListItemSeeders\SubjectsA1Seeder;
use Database\Seeders\ListItemSeeders\SubjectsA2Seeder;
use Database\Seeders\ListItemSeeders\TimePhrasesA1Seeder;
use Database\Seeders\ListItemSeeders\TimePhrasesA2Seeder;
use Database\Seeders\ListItemSeeders\TimePhrasesB1Seeder;
use Database\Seeders\ListItemSeeders\SubjectsB1Seeder;

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
        $this->call(GameSeeder::class);
        $this->call(PredicatesA2Seeder::class);
        $this->call(PluralsA1Seeder::class);
        $this->call(PluralsA2Seeder::class);
        $this->call(PredicatesA1Seeder::class);
        $this->call(SingularsAndPluralsA1Seeder::class);
        $this->call(SubjectsA1Seeder::class);
        $this->call(SubjectsA2Seeder::class);
        $this->call(TimePhrasesA1Seeder::class);
        $this->call(TimePhrasesA2Seeder::class);
        $this->call(TimePhrasesB1Seeder::class);
        $this->call(SubjectsB1Seeder::class);
    }
}
