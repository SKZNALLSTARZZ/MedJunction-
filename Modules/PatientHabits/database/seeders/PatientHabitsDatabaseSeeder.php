<?php

namespace Modules\PatientHabits\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Habit\Entities\Habit;
use Modules\Patient\Entities\Patient;
use Modules\PatientHabits\Entities\PatientHabits;

class PatientHabitsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();
        $habits = Habit::all();

        foreach ($patients as $patient) {
            $patientHabits = $habits->random(rand(1, 5));

            foreach ($patientHabits as $habit) {
                PatientHabits::factory()->create([
                    'patient_id' => $patient->id,
                    'habit_id' => $habit->id,
                ]);
            }
        }
    }
}
