<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Section;
use Livewire\Component;

class CurriculumCourse extends Component
{
    public $course;

    public $showFormCreate = false;
    public $formCreate = [
        'name' => null
    ];

    public $showFormEdit = false;
    public $formEdit = [
        'name' => null
    ];

    protected $listeners = ['render', 'sortSections'];

    public function sortSections($sorts){

        $sorts = collect($sorts);

        foreach ($this->course->sections as $section) {
            $section->position = $sorts->search($section->id) + 1;
            $section->save();
        }

    }

    public function mount(Course $course){

        $this->course = $course;

    }

    public function storeSection(){
        $this->validate([
            "formCreate.name" => 'required'
        ], 
        [],
        ['formCreate.name' => 'nombre']);

        $this->course->sections()->create([
            'name' => $this->formCreate['name']
        ]);

        $this->reset(['formCreate', 'showFormCreate']);
    }

    public function render()
    {

        $sections = Section::where('course_id', $this->course->id)
            ->orderBy('position', 'asc')
            ->get();

        return view('livewire.instructor.curriculum-course', compact('sections'))->layout('layouts.instructor');;
    }
}
