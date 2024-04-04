<?php

namespace Database\Factories;

use App\Models\Consultation;
use App\Models\Receptionist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'consultation_id' => Consultation::factory(),
            'receptionist_id' => Receptionist::factory(),
            'status' => $this->faker->randomElement(['paid', 'pending', 'failed']),
            'remarks' => $this->faker->sentence,
            'amount' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
