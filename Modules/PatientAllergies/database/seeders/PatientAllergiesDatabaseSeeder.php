<?php

namespace Modules\PatientAllergies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Allergy\Entities\Allergy;
use Modules\Patient\Entities\Patient;
use Modules\PatientAllergies\Entities\PatientAllergies;

class PatientAllergiesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();
        $allergies = Allergy::all();

        foreach ($patients as $patient) {
            $patientAllergies = $allergies->random(rand(1, 5));

            foreach ($patientAllergies as $allergy) {
                PatientAllergies::factory()->create([
                    'patient_id' => $patient->id,
                    'allergy_id' => $allergy->id,
                ]);
            }
        }
    }
}
