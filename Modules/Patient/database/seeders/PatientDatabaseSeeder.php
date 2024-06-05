<?php

namespace Modules\Patient\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Modules\Patient\Entities\Patient;
use Modules\Patient\Database\Factories\PatientFactory;

class PatientDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::where('role', 'patient')->pluck('id');
        $patients = collect();
        $userIds->each(function ($userId) use ($patients) {
            $patient = \Modules\Patient\Database\Factories\PatientFactory::new()->create(['user_id' => $userId]);
            $patients->push($patient);
        });
    }
}
