<?php

namespace Modules\Payment\Database\Factories;


use Modules\Receptionist\Entities\Receptionist;
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
            'receptionist_id' => Receptionist::factory(),
            'status' => $this->faker->randomElement(['paid', 'pending', 'failed']),
            'payment_type' => $faker->randomElement(['cash', 'credit_card', 'debit_card', 'cheque']),
            'remarks' => $this->faker->sentence,
            'amount' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
