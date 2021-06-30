<?php

namespace App\Observers;

use App\Models\Lesson;

class LessonObserver
{
    public function creating(Lesson $lesson)
    {

        $lesson->position = Lesson::where('section_id', $lesson->section_id)->count() + 1;

    }

    public function deleted(Lesson $lesson){

        $lessons = Lesson::where('section_id', $lesson->section_id)
        ->orderBy('position', 'asc')
        ->get();

        $i = 1;

        foreach ($lessons as $lesson) {
            $lesson->position = $i;
            $lesson->save();
            $i++;
        }
    }
}
