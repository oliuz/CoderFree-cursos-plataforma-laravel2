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

}
