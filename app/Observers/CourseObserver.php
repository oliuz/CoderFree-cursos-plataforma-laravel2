<?php

namespace App\Observers;

use App\Models\Course;

class CourseObserver
{
    public function created(Course $course){
        $course->sections()->create([
            'name' => 'Introducción'
        ]);
    }
}
