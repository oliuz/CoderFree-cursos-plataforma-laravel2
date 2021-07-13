<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'section_id'];

    //Accesores
    public function getOrderAttribute(){
        $course = $this->section->course;

        $sections = Section::where('course_id', $course->id)
        ->with('lessons')
        ->orderBy('position', 'asc')
        ->get();

        $lessons = collect();

        foreach ($sections as $section) {
            $lessons[] = $section->lessons->sortBy('position');
        }

        $lessons = $lessons->collapse();

        return $lessons->pluck('id')->search($this->id) + 1;
    }

    //Relaicion uno a uno
    public function description(){
        return $this->hasOne(Description::class);
    }

    //Relación uno a muchos

    public function resources(){
        return $this->hasMany(Resource::class);
    }

    //Relacion uno a muchos inversa

    public function section(){
        return $this->belongsTo(Section::class);
    }
}
