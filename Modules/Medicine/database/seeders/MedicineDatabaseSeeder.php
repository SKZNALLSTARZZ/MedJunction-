<?php

namespace Modules\Medicine\Database\Seeders;

use Illuminate\Database\Seeder;
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
        $medicines = Medicine::factory()->count(15)->create([
            'pharmacist_id' => $pharmacists->random(),
        ]);
    }
}
