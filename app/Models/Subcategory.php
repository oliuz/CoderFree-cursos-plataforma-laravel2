<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    //Relación uno a muchos
    public function courses(){
        return $this->hasMany(Course::class);
    }

    //Relacion uno a muchos inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
