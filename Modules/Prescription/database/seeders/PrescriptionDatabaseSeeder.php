<?php

namespace Modules\Prescription\Database\Seeders;

use Illuminate\Database\Seeder;
use Module\Consultation\Entities\Consultation;
use Modules\Prescription\Entities\Prescription;

class PrescriptionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consultations = Consultation::all();
        $prescriptions = Prescription::factory()->count(10)->create([
            'consultation_id' => $consultations->random(),
        ]);
    }
}
