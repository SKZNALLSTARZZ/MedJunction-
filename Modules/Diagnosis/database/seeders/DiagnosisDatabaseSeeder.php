<?php

namespace Modules\Diagnosis\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Diagnosis\Entities\Diagnosis;

class DiagnosisDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diagnoses = Diagnosis::factory()->count(15)->create();
    }
}
