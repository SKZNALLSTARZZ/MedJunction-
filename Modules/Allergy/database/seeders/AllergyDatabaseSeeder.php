<?php

namespace Modules\Allergy\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Allergy\Entities\Allergy;

class AllergyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allergies = Allergy::factory()->count(10)->create();
    }
}
