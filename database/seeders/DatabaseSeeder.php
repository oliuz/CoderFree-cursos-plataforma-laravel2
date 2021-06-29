<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('courses');
        Storage::makeDirectory('courses');

        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(LevelSeeder::class);

        $this->call(CourseSeeder::class);
    }
}
