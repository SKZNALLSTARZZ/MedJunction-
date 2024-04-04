<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_id' => Payment::factory(),
            'payment_type' => $this->faker->randomElement(['cash', 'credit_card', 'debit_card']),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'discount_amount' => $this->faker->optional()->randomFloat(2, 1, 100), // nullable
        ];
    }
}
