<?php

use Illuminate\Support\Facades\Route;
use Modules\Prescription\Http\Controllers\PrescriptionController;

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
    Route::apiResource('prescription', PrescriptionController::class)->names('prescription');
    Route::get('/Count_All_Prescription', [PrescriptionController::class, 'countAllPrescription']);
});
