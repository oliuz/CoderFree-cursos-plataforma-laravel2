<?php

namespace App\Http\Livewire\Instructor;

use Livewire\Component;

use Livewire\WithFileUploads;

class VideoLesson extends Component
{

    use WithFileUploads;

    protected $listeners = ['store'];

    public $lesson, $video;

    public function updatedVideo(){
        
        $this->emitSelf('store');
    }

    public function store(){
        $url = $this->video->store('lessons', 's3');

        $this->lesson->url = $url;
        $this->lesson->save();
    }

    public function render()
    {
        return view('livewire.instructor.video-lesson');
    }
}
