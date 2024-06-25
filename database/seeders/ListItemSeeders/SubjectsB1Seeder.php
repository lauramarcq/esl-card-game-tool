<?php

namespace Database\Seeders\ListItemSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListItem;
use App\Models\GameList;
use App\Models\Level;

class SubjectsB1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allValues = [
            'I', 'you', 'he', 'she', 'it', 'we', 'they', 'Alex', 'Emily', 'Ben', 'Sophia', 'Leo', 'Maya', 'Jake', 'Rachel', 'Lucas', 'Isabella', 'Oliver', 'Eva', 'Max', 'Chloe', 'Liam', 'Lily', 'Zoe', 'Gabriel', 'Mia', 'Mary\'s friend', 'Josh\'s sister', 'Emma\'s colleague', 'John\'s neighbor', 'David\'s cousin', 'Lily\'s teacher', 'Michael\'s boss', 'Sara\'s mentor', 'Jack\'s classmate', 'Olivia\'s uncle', 'Ethan\'s roommate', 'Mia\'s partner', 'Daniel\'s teammate', 'Chloe\'s advisor', 'Lucas\'s client', 'Grace\'s therapist', 'Sophie\'s coach', 'James\'s assistant', 'Olivia\'s nanny', 'Daniel\'s friend', 'Mia\'s sibling', 'happy dolphins', 'hungry sharks', 'a brave knight', 'a sad clown', 'three grandmas', 'a happy cow', 'two zombie friends', 'a unicorn', 'a lazy vampire'
        ];


        $levelB1 = Level::where('level', 'B1')->first();

        $allSortsList = GameList::where('name', 'Miscellaneous All Sorts')->where('level_id', $levelB1->id)->first();

        foreach ($allValues as $value) {
            ListItem::factory()->create([
                'game_list_id' => $allSortsList->id,
                'item_value' => $value,
                'plural' => null,
            ]);
        }
    }
}
