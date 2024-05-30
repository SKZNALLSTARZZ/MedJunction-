<?php

namespace Modules\Treatment\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Service\Entities\Service;
use Modules\Treatment\Entities\Treatment;

class TreatmentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = Service::all();
        $treatments = Treatment::factory()->count(10)->create([
            'service_id' => $services->random(),
        ]);
    }
}
