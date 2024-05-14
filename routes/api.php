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
use App\Http\Controllers\FileController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\Auth\RegisterController;



Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::apiResource('Nurse', NurseController::class);

Route::apiResource('Appointment', AppointmentController::class);

Route::apiResource('Consultation', ConsultationController::class);

Route::apiResource('Department', DepartmentController::class);

Route::apiResource('Prescription', PrescriptionController::class);

Route::prefix('Patient')->group(function () {
    Route::apiResource('/patients', PatientController::class);
    Route::get('/Count', [PatientController::class, 'count']);
});

Route::apiResource('Doctor', DoctorController::class);

Route::apiResource('Specialty', SpecialtyController::class);

Route::apiResource('Receptionist', ReceptionistController::class);

Route::apiResource('Pharmacist', PharmacistController::class);

Route::apiResource('Payment', PaymentController::class);

Route::apiResource('Invoice', InvoiceController::class);

Route::apiResource('Medicine', MedicineController::class);

Route::apiResource('Service', ServiceController::class);

Route::post('/upload', [FileController::class, 'upload']);




