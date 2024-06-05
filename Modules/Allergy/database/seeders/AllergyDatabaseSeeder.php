<?php

namespace Modules\Allergy\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Allergy\Database\Factories\AllergyFactory;

class AllergyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Modules\Allergy\Database\Factories\AllergyFactory::new()->count(10)->create();
    }
}
