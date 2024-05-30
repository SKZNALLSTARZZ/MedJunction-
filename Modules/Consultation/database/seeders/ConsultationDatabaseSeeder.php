<?php

namespace Modules\Consultation\Database\Seeders;

use Modules\Nurse\Entities\Nurse;
use Modules\Doctor\Entities\Doctor;
use Illuminate\Database\Seeder;
use Modules\Patient\Entities\Patient;
use Modules\Appointment\Entities\Appointment;
use Module\Consultation\Entities\Consultation;

class ConsultationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = Doctor::all();
        $nurses = Nurse::all();
        $patients = Patient::all();
        $appointments = Appointment::all();

        $consultations = Consultation::factory()->count(15)->create([
            'doctor_id' => $doctors->random(),
            'nurse_id' => $nurses->random(),
            'patient_id' => $patients->random(),
            'appointment_id' => $appointments->random(),
        ]);
    }
}
