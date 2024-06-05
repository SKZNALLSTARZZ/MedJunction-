<?php

namespace Modules\Diagnosis\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Diagnosis\Entities\Diagnosis;
use Modules\Diagnosis\Database\Factories\DiagnosisFactory;

class DiagnosisDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Modules\Diagnosis\Database\Factories\DiagnosisFactory::new()->count(15)->create();
    }
}
