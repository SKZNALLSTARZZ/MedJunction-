<?php

namespace Modules\Prescription\Database\Factories;

use Module\Consultation\Entities\Consultation;
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
            'consultation_id' => Consultation::Factory(),
            'dosage' => $this->faker->numberBetween(0, 10),
            'quantity' => $this->faker->numberBetween(0, 5),
            'instructions' => $this->faker->sentence,
            'amount' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
