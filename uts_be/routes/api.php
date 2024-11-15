<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/patients', [PatientController::class, 'index']);
    Route::post('/patients', [PatientController::class, 'store']);
    Route::get('/patients/{id}', [PatientController::class, 'show']);
    Route::put('/patients/{id}', [PatientController::class, 'update']);
    Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

    Route::get('/patients/search/{name}', [PatientController::class, 'searchPatientsByName']);
    Route::get('/patients/status/positive', [PatientController::class, 'searchPatientsPositive']);
    Route::get('/patients/status/recovered', [PatientController::class, 'searchPatientsRecovered']);
    Route::get('/patients/status/dead', [PatientController::class, 'searchPatientsDead']);

    Route::post('/auth/logout', [AuthController::class, 'logout']);
});
