<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
use App\Http\Controllers\PatientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MedicalHistoryController;


Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::apiResource('Employee', EmployeeController::class);

Route::apiResource('Appointment', AppointmentController::class);

Route::apiResource('Department', DepartmentController::class);

Route::apiResource('Medicalhistory', MedicalHistoryController::class);

Route::apiResource('Patient', PatientController::class);

Route::apiResource('Specialty', SpecialtyController::class);

