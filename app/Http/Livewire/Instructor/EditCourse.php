<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;

class EditCourse extends Component
{
    use WithFileUploads;

    public $course, $slug, $categories, $subcategories, $category_id, $levels, $photo, $identificador;

    public $rules = [
        'course.title' => 'required',
        'slug' => 'required',
        'course.subtitle' => 'required',
        'course.description' => 'required',
        'course.subcategory_id' => 'required',
        'course.level_id' => 'required',
    ];

    public function mount(Course $course){

        $this->identificador = rand();

        $this->course = $course;
        $this->slug = $course->slug;

        $this->categories = Category::all();
        $this->category_id = $course->subcategory->category->id;
        $this->subcategories = Subcategory::whereHas('category', function(Builder $query){
            $query->where('id', $this->category_id);
        })->get();
        $this->levels = Level::all();
    }

    public function updatedCourseTitle($value){
        $this->slug = Str::slug($value);
    }

    public function updatedCategoryId(){
        $this->subcategories = Subcategory::whereHas('category', function(Builder $query){
            $query->where('id', $this->category_id);
        })->get();

        $this->course->subcategory_id = $this->subcategories->first()->id;
    }

    public function save(){

        if($this->photo){
            $this->rules['photo'] = 'image';
        }

        $this->validate();

        if($this->photo){

            Storage::delete([$this->course->image]);
            $this->course->image = $this->photo->store('courses');
        }

        $this->course->slug = $this->slug;
        $this->course->save();

        $this->reset('photo');
        $this->identificador = rand();

        session()->flash('flash.banner', '¡La información del curso se actualizó con éxito!');
        session()->flash('flash.bannerStyle', 'success');

        $this->emit('saved');
        
    }

    public function render()
    {
        return view('livewire.instructor.edit-course')->layout('layouts.instructor');
    }
}