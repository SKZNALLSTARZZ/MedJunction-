<?php

namespace Modules\VitalSign\Database\Factories;

use Module\Consultation\Entities\Consultation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VitalSign>
 */
class VitalSignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body_temperature' => $this->faker->randomFloat(2, 35, 40),
            'pulse_rate' => $this->faker->numberBetween(60, 100),
            'respiration_rate' => $this->faker->numberBetween(12, 20),
            'blood_pressure' => $this->faker->randomElement(['120/80', '130/90', '140/100']),
            'oxygen_saturation' => $this->faker->numberBetween(90, 100),
            'consultation_id' => Consultation::Factory(),
        ];
    }
}
