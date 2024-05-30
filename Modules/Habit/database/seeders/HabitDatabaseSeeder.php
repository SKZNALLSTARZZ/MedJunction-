<?php

namespace Modules\Habit\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Patient\Entities\Patient;
use Modules\Habit\Entities\Habit\Habit;

class HabitDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();
        $habits = Habit::factory()->count(10)->create([
            'patient_id' => $patients->random(),
        ]);
    }
}
