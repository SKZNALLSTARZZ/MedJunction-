<?php

namespace Modules\Receptionist\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Modules\Receptionist\Database\Factories\ReceptionistFactory;

class ReceptionistDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::where('role', 'receptionist')->pluck('id');
        $receptionists = collect();
        $userIds->each(function ($userId) use ($receptionists) {
            $receptionist = \Modules\Receptionist\Database\Factories\ReceptionistFactory::new()->create(['user_id' => $userId]);
            $receptionists->push($receptionist);
        });
    }
}
