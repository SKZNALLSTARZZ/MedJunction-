<?php

use Illuminate\Support\Facades\Route;
use Modules\PatientAllergies\Http\Controllers\PatientAllergiesController;

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

Route::group([], function () {
    Route::resource('patientallergies', PatientAllergiesController::class)->names('patientallergies');
});
