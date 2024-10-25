<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/students', [StudentController::class, 'index'])->name('students');
Route::post('/students', [StudentController::class, 'store']);
