<?php

namespace Modules\MedicalHistory\Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\MedicalHistoryFactory;

class MedicalHistoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Modules\MedicalHistory\Database\Factories\MedicalHistoryFactory::new()->count(10)->create();
    }
}
