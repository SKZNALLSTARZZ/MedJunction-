<?php

namespace Modules\Medicine\Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\MedicineFactory;
use Modules\Medicine\Entities\Medicine;
use Modules\Pharmacist\Entities\Pharmacist;

class MedicineDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pharmacists = Pharmacist::all();
        \Modules\Medicine\Database\Factories\MedicineFactory::new()->count(15)->create([
            'pharmacist_id' => $pharmacists->random(),
        ]);
    }
}
