<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'video', 'section_id'];

    //Accesores
    public function getPositionAttribute(){
        $course = $this->section->course;
        return $course->lessons->pluck('id')->search($this->id);
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
