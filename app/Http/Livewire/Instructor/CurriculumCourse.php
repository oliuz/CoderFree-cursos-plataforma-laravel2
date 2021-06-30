<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use Livewire\Component;

class CurriculumCourse extends Component
{
    public $course, $sections ,$section;

    public $showFormCreate = false;
    public $formCreate = [
        'name' => null
    ];

    public $showFormEdit = false;
    public $formEdit = [
        'name' => null
    ];

    protected $listeners = ['delete', 'sortSections', 'sortLessons', 'deleteLesson'];

    public function mount(Course $course){

        $this->course = $course;
        $this->getSections();

    }

    public function getSections(){
        $this->sections = Section::where('course_id', $this->course->id)
        ->orderBy('position', 'asc')
        ->get();
    }

    public function store(){
        $this->validate([
            "formCreate.name" => 'required'
        ], 
        [],
        ['formCreate.name' => 'nombre']);

        $this->course->sections()->create([
            'name' => $this->formCreate['name']
        ]);

        $this->reset(['formCreate', 'showFormCreate']);

        $this->getSections();
    }

    public function edit(Section $section){

        $this->resetValidation('formEdit.name');

        $this->section = $section;
        $this->showFormEdit = true;
        $this->formEdit['name'] = $section->name;
    }

   

    public function update(){

        $this->validate([
            'formEdit.name' => 'required'
        ],
        [],
        [
            'formEdit.name' => 'nombre'
        ]);

        $this->section->name = $this->formEdit['name'];
        $this->section->save();

        $this->reset(['formEdit', 'section', 'showFormEdit']);

        $this->getSections();
    }

    public function delete(Section $section){
        $section->delete();
        $this->getSections();
    }

    public function deleteLesson(Lesson $lesson){
        $lesson->delete();

        $this->emit('getLessons');
    }

    public function cancelEdit(){
        $this->reset('showFormEdit');
    }

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
        
    }

    public function render()
    {

        return view('livewire.instructor.curriculum-course')->layout('layouts.instructor');
    }
}
