<?php

namespace App\Http\Livewire\Instructor;

use Livewire\Component;

class CreateSection extends Component
{
    public $course;
    public $showForm = false, $name;

    protected $rules = [
        'name' => 'required'
    ];

    public function save(){
        $this->validate();

        $this->course->sections()->create([
            'name' => $this->name
        ]);

        $this->reset(['name', 'showForm']);

        $this->emitTo('instructor.curriculum-course', 'render');
    }

    public function render()
    {
        return view('livewire.instructor.create-section');
    }
}
