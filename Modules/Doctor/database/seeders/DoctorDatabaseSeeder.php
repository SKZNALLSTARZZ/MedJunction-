<?php

namespace Modules\Doctor\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Modules\Doctor\Entities\Doctor;
use Modules\Department\Entities\Department;
use Modules\Speciality\Entities\Speciality;

class DoctorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $departments = Department::all();
        $specialities = Speciality::all();

        $doctors = Doctor::factory()->count(10)->create([
            'user_id' => $users->random(),
            'department_id' => $departments->random(),
            'speciality_id' => $specialities->random(),
        ]);
    }
}
