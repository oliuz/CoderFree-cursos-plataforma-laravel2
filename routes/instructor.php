<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Instructor\ShowCourses;
use App\Http\Livewire\Instructor\EditCourse;
use App\Http\Livewire\Instructor\CurriculumCourse;


Route::redirect('/', '/instructor/courses');

Route::get('/courses', ShowCourses::class)->name('instructor.courses.index');
Route::get('/courses/{course}/edit', EditCourse::class)->name('instructor.courses.edit');
Route::get('/courses/{course}/curriculum', CurriculumCourse::class)->name('instructor.courses.curriculum');