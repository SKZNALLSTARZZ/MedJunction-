<?php

namespace Modules\MedicalHistory\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Patient\Entities\Patient;
use Modules\MedicalHistory\Entities\MedicalHistory;

class MedicalHistoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();
        $medicalhistories = MedicalHistory::factory()->count(10)->create([
            'patient_id' => $patients->random(),
        ]);
    }
}
