<?php

namespace Modules\Speciality\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Speciality\Entities\Speciality;
use Modules\Speciality\Database\Factories\SpecialityFactory;

class SpecialityDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Modules\Speciality\Database\Factories\SpecialityFactory::new()->count(8)->create([]);
    }
}
