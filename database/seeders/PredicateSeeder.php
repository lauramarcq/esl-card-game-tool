<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Predicate;

class PredicateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Predicate::factory()->create([
        'predicate' => 'on the table',
        'is_phrase' => true,
      ]);
      Predicate::factory()->create([
        'predicate' => 'red',
        'is_phrase' => false,
      ]);  
    }
}
