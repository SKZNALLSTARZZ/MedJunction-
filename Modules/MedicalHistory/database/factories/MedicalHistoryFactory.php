<?php

namespace Modules\MedicalHistory\Database\Factories;


use Modules\Patient\Entities\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalHistory\Entities\MedicalHistory;

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
    protected $model = MedicalHistory::class;

    public function definition(): array
    {
        $patients = Patient::all();
        return [
            'patient_id' => $patients->random()->id,
            'date' => $this->faker->dateTimeThisYear(),
            'medical_condition' => $this->faker->sentence,
            'treatment' => $this->faker->paragraph,
            'outcome' => $this->faker->randomElement(['recovered', 'ongoing', 'deceased']),
        ];
    }
}
