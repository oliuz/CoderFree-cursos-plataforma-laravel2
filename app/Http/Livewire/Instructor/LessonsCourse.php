<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Lesson;
use Livewire\Component;

use Livewire\WithFileUploads;

class LessonsCourse extends Component
{

    use WithFileUploads;

    public $video;

    public $section, $lessons, $lesson;

    protected $listeners = ['getLessons'];

    protected $validationAttributes = [
        'formCreateLesson.name' => 'nombre',
        'formEditLesson.name' => 'nombre',
    ];

    public function mount(){
        $this->getLessons();
    }

    //Lessons
    public $formCreateLesson=[
        'open' => false,
        'name' => null
    ];

    public $formEditLesson=[
        'open' => false,
        'name' => null
    ];

    public function getLessons(){
        $this->lessons = Lesson::where('section_id', $this->section->id)
        ->orderBy('position', 'asc')
        ->get();
    }

    public function storeLesson(){
        $this->validate([
            'formCreateLesson.name' => 'required'
        ]);

        $this->section->lessons()->create([
            'name' => $this->formCreateLesson['name']
        ]);

        $this->reset(['formCreateLesson']);
        $this->getLessons();
    }

    public function editLesson(Lesson $lesson){

        $this->resetValidation('formEditLesson.name');

        $this->formEditLesson['open'] = true;
        $this->formEditLesson['name'] = $lesson->name;
        $this->lesson = $lesson;
    }

    public function cancelEditLesson(){
        $this->formEditLesson['open'] = false;
    }

    public function updateLesson(){

        $this->validate([
            'formEditLesson.name' => 'required'
        ]);

        $this->lesson->name = $this->formEditLesson['name'];
        $this->lesson->save();

        $this->reset('formEditLesson');

        $this->getLessons();
    }

    public function render()
    {
        return view('livewire.instructor.lessons-course');
    }
}
