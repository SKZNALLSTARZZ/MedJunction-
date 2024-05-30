<?php

use Illuminate\Support\Facades\Route;
use Modules\Habit\Http\Controllers\HabitController;

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
    Route::resource('habit', HabitController::class)->names('habit');
});
