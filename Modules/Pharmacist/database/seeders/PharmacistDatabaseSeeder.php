<?php

namespace Modules\Pharmacist\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Modules\Pharmacist\Entities\Pharmacist;

class PharmacistDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $pharmacists = Pharmacist::factory()->count(10)->create([
            'user_id' => $users->random(),
        ]);
    }
}
