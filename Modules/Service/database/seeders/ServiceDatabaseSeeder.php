<?php

namespace Modules\Service\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Service\Entities\Service;
use Module\Speciality\Entities\Speciality;

class ServiceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialities = Speciality::all();
        $services = Service::factory()->count(10)->create([
            'speciality_id' => $specialities->random(),
        ]);
    }
}
