<?php

namespace App\Http\Livewire\Instructor;

use Livewire\Component;

class EditSection extends Component
{

    public $section, $position;

    protected $rules = [
        'section.name' => 'required'
    ];

    public function render()
    {
        return view('livewire.instructor.edit-section');
    }
}
