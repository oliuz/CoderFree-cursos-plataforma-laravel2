<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Lesson;
use Livewire\Component;

class ShowLessons extends Component
{

    public $open = false;

    public $section, $lessons;

    public $showFormCreate = false;
    public $formCreate = [
        'name' => null
    ];

    protected $listeners = ['getLessons'];

    public function mount(){
        $this->getLessons();
    }

    public function getLessons(){
        $this->lessons = Lesson::where('section_id', $this->section->id)
        ->orderBy('position', 'asc')
        ->get();
    }

    public function store(){
        $this->validate([
            'formCreate.name' => 'required'
        ],
        [],
        [
            'formCreate.name' => 'nombre'
        ]);

        $this->section->lessons()->create([
            'name' => $this->formCreate['name']
        ]);

        $this->reset(['showFormCreate', 'formCreate']);
        $this->getLessons();
    }

    public function render()
    {
        return view('livewire.instructor.show-lessons')->layout('layouts.instructor');
    }
}
