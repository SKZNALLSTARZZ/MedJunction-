<?php

namespace Modules\VitalSign\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\VitalSign\Entities\VitalSign;
use Module\Consultation\Entities\Consultation;

class VitalSignDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consultations = Consultation::all();
        $vitalSigns = VitalSign::factory()->count(10)->create([
            'consultation_id' -> $consultations->random(),
        ]);
    }
}
