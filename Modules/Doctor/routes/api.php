<?php

use Illuminate\Support\Facades\Route;
use Modules\Doctor\Http\Controllers\DoctorController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('doctor', DoctorController::class)->names('doctor');
    Route::get('/consulted-patients', [DoctorController::class, 'consultedPatients']);
    Route::get('/consulted-patient-counts', [DoctorController::class, 'getConsultedPatientCounts']);
    Route::get('/doctor-appointments', [DoctorController::class, 'getAppointments']);
    Route::get('/doctor-appointments-of-patient/{patientId}', [DoctorController::class, 'getAppointmentsOfPatient']);
});
