<?php

namespace App\Http\Livewire\Instructor;

use Livewire\Component;

class ShowCourses extends Component
{
    public function render()
    {

        $courses = auth()->user()->courses_dictated()->paginate(5);

        return view('livewire.instructor.show-courses', compact('courses'))->layout('layouts.instructor');
    }
}
