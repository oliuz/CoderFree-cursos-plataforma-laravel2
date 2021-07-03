<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use Livewire\Component;

class CurriculumCourse extends Component
{

    public $course, $sections, $section;

    protected $listeners = ['deleteSection', 'deleteLesson'];

    protected $validationAttributes = [
        'formCreateSection.name' => 'nombre',
        'formEditSection.name' => 'nombre',
        'formEditLesson.name' => 'required'
    ];

    public function mount(Course $course){
        $this->course = $course;
        $this->getSections();
    }

    /* Section */

    public $formCreateSection=[
        'open' => false,
        'name' => null
    ];

    public $formEditSection=[
        'open' => false,
        'name' => null
    ];

    public function getSections(){
        $this->sections = Section::where('course_id', $this->course->id)
            ->orderBy('position', 'asc')
            ->get();
    }

    public function storeSection(){
        $this->validate([
            'formCreateSection.name' => 'required'
        ]);

        $this->course->sections()->create([
            'name' => $this->formCreateSection['name']
        ]);

        $this->reset(['formCreateSection']);

        $this->getSections();
    }

    public function editSection(Section $section){

        $this->resetValidation('formEditSection.name');

        $this->section = $section;
        $this->formEditSection['open'] = true;
        $this->formEditSection['name'] = $section->name;
    }

    public function updateSection(){
        $this->validate([
            'formEditSection.name' => 'required'
        ]);

        $this->section->name = $this->formEditSection['name'];
        $this->section->save();

        $this->reset(['formEditSection', 'section']);

        $this->getSections();
    }

    public function cancelEditSection(){
        $this->formEditSection['open'] = false;
    }

    public function deleteSection(Section $section){
        $section->delete();
        $this->getSections();
    }

    /* Lesson */
    public function deleteLesson(Lesson $lesson){
        $lesson->delete();

        $this->emit('getLessons');
    }
    

    /* 
    

    protected $listeners = ['delete', 'sortSections', 'sortLessons', 'deleteLesson'];

    


    public function sortSections($sorts){

        $sorts = collect($sorts);

        foreach ($this->course->sections as $section) {
            $section->position = $sorts->search($section->id) + 1;
            $section->save();
        }

        $this->getSections();
        $this->emit('getLessons');
    }

    public function sortLessons($data){

        $sorts = $data[0];

        foreach ($sorts as $key => $sort) {

            $lesson = Lesson::find($sort);
            
            $lesson->section_id = $data[1];
            $lesson->position = $key + 1;

            $lesson->save();
        }

        $this->emit('getLessons');
        
    } */

    public function render()
    {

        return view('livewire.instructor.curriculum-course')->layout('layouts.instructor');
    }
}
