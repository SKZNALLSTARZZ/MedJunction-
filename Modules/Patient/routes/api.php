<?php

use Illuminate\Support\Facades\Route;
use Modules\Patient\Http\Controllers\PatientController;

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
    Route::apiResource('patient', PatientController::class)->names('patient');
    Route::get('/Count', [PatientController::class, 'count']);
    Route::get('/Count_All_Patient', [PatientController::class, 'countAllPatient']);
    Route::get('/get_Last_Five_Patients', [PatientController::class, 'getFivePatients']);
    Route::get('/patientconsultations/{patientId}', [PatientController::class, 'getConsultations']);
    Route::get('/patientappointments/{patientId}', [PatientController::class, 'getAppointments']);
});

