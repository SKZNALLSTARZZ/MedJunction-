<?php

namespace Database\Seeders;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Nurse;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Medicine;
use App\Models\Department;
use App\Models\Pharmacist;
use App\Models\Speciality;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\Receptionist;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory()->count(10)->create();

        // Seed departments
        $departments = Department::factory()->count(5)->create();

        // Seed specialities
        $specialities = Speciality::factory()->count(5)->create();

        // Seed doctors
        $doctors = Doctor::factory()->count(10)->create([
            'user_id' => $users->random(),
            'department_id' => $departments->random(),
            'speciality_id' => $specialities->random(),
        ]);

        // Seed patients
        $userIds = User::where('type', 'patient')->pluck('id');

        // Loop through each user ID and create a patient
        $patients = collect();
        $userIds->each(function ($userId) use ($patients) {
            $patient = Patient::factory()->create(['user_id' => $userId]);
            $patients->push($patient);
        });

        // Seed nurses
        $nurses = Nurse::factory()->count(5)->create([
            'user_id' => $users->random(),
            'department_id' => $departments->random(),
        ]);

        // Seed appointments
        $appointments = Appointment::factory()->count(20)->create([
            'doctor_id' => $doctors->random(),
            'patient_id' => $patients->random(),
        ]);

        // Seed consultations
        $consultations = Consultation::factory()->count(15)->create([
            'doctor_id' => $doctors->random(),
            'nurse_id' => $nurses->random(),
            'patient_id' => $patients->random(),
            'appointment_id' => $appointments->random(),
        ]);

        // Seed prescriptions
        $prescriptions = Prescription::factory()->count(15)->create([
            'consultation_id' => $consultations->random(),
        ]);

        // Seed receptionists
        $receptionists = Receptionist::factory()->count(15)->create([
            'user_id' => $users->random(),
        ]);

        // Seed pharmacists
        $pharmacists = Pharmacist::factory()->count(15)->create([
            'user_id' => $users->random(),
        ]);

        // Seed payments
        $payments = Payment::factory()->count(15)->create([
            'consultation_id' => $consultations->random(),
            'receptionist_id' => $receptionists->random(),
        ]);

        // Seed invoices
        $invoices = Invoice::factory()->count(10)->create([
            'payment_id' => $payments->random(),
        ]);

        // Seed services
        $services = Service::factory()->count(15)->create([
            'speciality_id' => $specialities->random(),
        ]);

        // Seed medicines
        $medicines = Medicine::factory()->count(15)->create([
            'pharmacist_id' => $pharmacists->random(),
        ]);
    }
}
