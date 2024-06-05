<?php

namespace Modules\Prescription\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Prescription\Database\Factories\PrescriptionFactory;

class PrescriptionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Modules\Prescription\Database\Factories\PrescriptionFactory::new()->count(10)->create();
    }
}
