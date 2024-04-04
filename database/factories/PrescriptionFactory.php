<?php

namespace Database\Factories;

use App\Models\Consultation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\[=Prescription]>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'state' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'symptom' => $this->faker->sentence,
            'advice' => substr($this->faker->paragraph, 0, 255),
            'medicine' => $this->faker->words(3, true),
            'validity' => $this->faker->randomElement(['1 week', '2 weeks', '1 month']),
            'consultation_id' => Consultation::Factory(),
        ];
    }
}
