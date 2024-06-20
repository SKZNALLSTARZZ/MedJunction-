<?php

namespace Modules\MedicinePrescription\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Medicine\Entities\Medicine;
use Modules\Prescription\Entities\Prescription;
use Modules\MedicinePrescription\Entities\MedicinePrescription;

class MedicinePrescriptionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prescriptions = Prescription::all();
        $medicines = Medicine::all();

        foreach ($prescriptions as $prescription) {
            $prescriptionMedicines = $medicines->random(rand(1, 5));

            foreach ($prescriptionMedicines as $medicine) {
                MedicinePrescription::factory()->create([
                    'prescription_id' => $prescription->id,
                    'medicine_id' => $medicine->id,
                ]);
            }
        }
    }
}
