<?php

namespace Modules\Speciality\Database\Seeders;

use Illuminate\Database\Seeder;
use Module\Speciality\Entities\Speciality;

class SpecialityDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialities = Speciality::factory()->count(5)->create();
    }
}
