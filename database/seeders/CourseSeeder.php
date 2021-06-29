<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Goal;
use App\Models\Requirement;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::factory(16)->create()->each(function(Course $course){
            Requirement::factory(6)->create([
                'course_id' => $course->id
            ]);

            Goal::factory(6)->create([
                'course_id' => $course->id
            ]);

        });
    }
}
