<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Idea;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $userSeedCount = 30;
        $ideaSeedCount = 50;
        $commentSeedCount = 200;

        $users = User::factory()->count($userSeedCount)->create();

        // $ideas = Idea::factory()->count(100)->create([
        //     'user_id' => function() use ($users){
        //         return $users->random()->id;
        //     }
        // ]);

        $ideas = Idea::factory()->count($ideaSeedCount)->create([
            'user_id' => fn() => $users->random()->id
        ]);

        Comment::factory()->count($commentSeedCount)->create([
            'user_id' => fn() => $users->random()->id,
            'idea_id' => fn() => $ideas->random()->id
        ]);
    }
}
