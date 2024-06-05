<?php

namespace Modules\Treatment\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Treatment\Database\Factories\TreatmentFactory;

class TreatmentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Modules\Treatment\Database\Factories\TreatmentFactory::new()->count(10)->create();
    }
}
