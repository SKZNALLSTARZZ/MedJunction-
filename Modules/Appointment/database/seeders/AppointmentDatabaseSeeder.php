<?php

namespace Modules\Appointment\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Patient\Entities\Patient;
use Modules\Doctor\Entities\Doctor;
use Modules\Appointment\Entities\Appointment;

class AppointmentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = Doctor::all();
        $patients = Patient::all();

        $appointments = Appointment::factory()->count(20)->create([
            'doctor_id' => $doctors->random(),
            'patient_id' => $patients->random(),
        ]);
    }
}
