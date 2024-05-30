<?php

namespace Modules\Receptionist\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Modules\Receptionist\Entities\Receptionist;

class ReceptionistDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $receptionists = Receptionist::factory()->count(10)->create([
            'user_id' => $users->random(),
        ]);
    }
}
