<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/animals', [AnimalController::class, 'index'])->name('animals');

Route::post('/animals', [AnimalController::class, 'store'])->name('animal.store');

Route::put('/animals/{id}', [AnimalController::class, 'update'])->name("animals.update");

Route::delete('animals/{id}', [AnimalController::class, 'destroy'])->name('animals.delete');
