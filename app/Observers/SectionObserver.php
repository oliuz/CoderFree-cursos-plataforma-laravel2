<?php

namespace App\Observers;

use App\Models\Course;
use App\Models\Section;

class SectionObserver
{
   
    public function creating(Section $section)
    {

        $section->position = Section::where('course_id', $section->course_id)->count() + 1;

    }

    public function deleted(Section $section){
        $sections = Section::where('course_id', $section->course->id)
        ->orderBy('position', 'asc')
        ->get();

        $i = 1;

        foreach ($sections as $section) {
            $section->position = $i;
            $section->save();
            $i++;
        }
    }

}
