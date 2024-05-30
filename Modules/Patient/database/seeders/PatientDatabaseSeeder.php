<?php

namespace Modules\Patient\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Modules\Patient\Entities\Patient;

class PatientDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::where('type', 'patient')->pluck('id');
        $patients = collect();
        $userIds->each(function ($userId) use ($patients) {
            $patient = Patient::factory()->create(['user_id' => $userId]);
            $patients->push($patient);
        });
    }
}
