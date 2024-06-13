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

Route::get('patientconsultation/{patientId}', [PatientController::class, 'getConsultations']);
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient', PatientController::class)->names('patient');
    Route::get('/Count', [PatientController::class, 'count']);
});

