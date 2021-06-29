<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PENDIENTE = 2;
    const APROBADO = 3;

    protected $guarded = ['id', 'status','created_at', 'updated_at'];

    //Relacion uno a muchos
    public function requirements(){
        return $this->hasMany(Requirement::class);
    }

    public function goals(){
        return $this->hasMany(Goal::class);
    }

    public function sections(){
        return $this->hasMany(Section::class);
    }

    //Relacion uno a muchos inversa
    public function teacher(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    //Relacion muchos a muchos
    public function students(){
        return $this->belongsToMany(User::class);
    }

    //Relacion Has Many Through
    public function lessons(){
        return $this->hasManyThrough(Lesson::class, Section::class);
    }
}
