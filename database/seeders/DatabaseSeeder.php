<?php

namespace Database\Seeders;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Nurse;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Department;
use App\Models\Speciality;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Prescription;
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
        $patients = Patient::factory()->count(10)->create([
            'user_id' => $users->random(),
        ]);

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
        $prescriptions = Prescription::factory()->count(15)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
