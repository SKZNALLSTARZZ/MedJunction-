<?php

namespace Database\Factories;


use Modules\Patient\Entities\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalHistory>
 */
class MedicalHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'date' => $faker->dateTimeThisYear(),
            'medical_condition' => $faker->sentence,
            'treatment' => $faker->paragraph,
            'outcome' => $faker->randomElement(['recovered', 'ongoing', 'deceased']),
        ];
    }
}
