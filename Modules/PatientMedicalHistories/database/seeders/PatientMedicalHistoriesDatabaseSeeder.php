<?php

namespace Modules\PatientMedicalHistories\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Patient\Entities\Patient;
use Modules\MedicalHistory\Entities\MedicalHistory;
use Modules\PatientMedicalHistories\Entities\PatientMedicalHistories;

class PatientMedicalHistoriesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();
        $medicalHistories = MedicalHistory::all();

        foreach ($patients as $patient) {
            $patientMedicalHistories = $medicalHistories->random(rand(1, 5));

            foreach ($patientMedicalHistories as $medicalHistory) {
                PatientMedicalHistories::factory()->create([
                    'patient_id' => $patient->id,
                    'medical_history_id' => $medicalHistory->id,
                ]);
            }
        }
    }
}
