<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Idea;
use \App\Models\PinCategory;
use \App\Models\Pin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $pin_categories_file_path = 'sql_files_for_seeder/pin_categories.sql';
        $pins_file_path = 'sql_files_for_seeder/pins.sql';
        \DB::unprepared(file_get_contents($pin_categories_file_path));
        \DB::unprepared(file_get_contents($pins_file_path));

        $userSeedCount = 30;
        $ideaSeedCount = 50;
        $commentSeedCount = 200;
        // $pinCategorySeedCount = 3;
        // $pinSeedCount = 10;

        $users = User::factory()->count($userSeedCount)->create();

        $ideas = Idea::factory()->count($ideaSeedCount)->create([
            'user_id' => fn() => User::inRandomOrder()->first()->id
        ]);

        Comment::factory()->count($commentSeedCount)->create([
            'user_id' => fn() => User::inRandomOrder()->first()->id,
            'idea_id' => fn() => Idea::inRandomOrder()->first()->id
        ]);

        // $pinCategories = PinCategory::factory()->count($pinCategorySeedCount)->create();

        // $pins = Pin::factory()->count($pinSeedCount)->create([
        //     'pin_category_id' => fn() => $pinCategories->random()->id,
        // ]);

        // foreach ($users as $user) {
        //     // Attach 1 to 5 random pins to each user
        //     $user->pins()->attach(
        //         $pins->random(rand(1, 5))->pluck('id')->toArray()
        //     );
        // }
    }
}
