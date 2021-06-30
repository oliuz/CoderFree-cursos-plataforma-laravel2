<?php

use App\Models\Course;
use App\Models\Section;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('prueba', function () {
    $sections = Section::where('course_id', 1)
        ->with('lessons')
        ->orderBy('position', 'asc')
        ->get();

    $lessons = collect();
    foreach ($sections as $section) {
        $lessons[] = $section->lessons->sortBy('position');
    }

    $lessons = $lessons->collapse();

    return $lessons;
    /* return $lessons->pluck('id')->search(5); */

    /* return $lessons->search(2); */
});
