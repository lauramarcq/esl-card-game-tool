<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\SubjectSeeder;
use Database\Seeders\PredicateSeeder;
use Database\Seeders\TimePhraseSeeder;

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

        $this->call(SubjectSeeder::class);
        $this->call(PredicateSeeder::class);
        $this->call(TimePhraseSeeder::class);
    }


}
