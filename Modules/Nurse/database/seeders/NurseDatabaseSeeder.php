<?php

namespace Modules\Nurse\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Modules\Nurse\Entities\Nurse;
use Modules\Department\Entities\Department;

class NurseDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $department = Department::all();

        $nurses = Nurse::factory()->count(10)->create([
            'user_id' => $users->random(),
            'department_id' => $departments->random(),
        ]);
    }
}
