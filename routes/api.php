<?php

use App\Http\Controllers\KlassController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'klasses' => KlassController::class,
    'lessons' => LessonController::class,
    'students' => StudentController::class,
]);
Route::get('/klasses/{klass}/lessons', [KlassController::class, 'getLessons']);
Route::put('/klasses/{klass}/lessons', [KlassController::class, 'syncLessons']);