<?php

namespace Modules\Doctor\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Modules\Doctor\Database\Factories\DoctorFactory;

class DoctorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::where('role', 'doctor')->pluck('id');
        $doctors = collect();
        $userIds->each(function ($userId) use ($doctors) {
            $doctor = \Modules\Doctor\Database\Factories\DoctorFactory::new()->create(['user_id' => $userId]);
            $doctors->push($doctor);
        });
    }
}
