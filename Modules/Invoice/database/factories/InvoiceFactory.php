<?php

namespace Modules\Invoice\Database\Factories;


use Modules\Payment\Entities\Payment;
use Module\Consultation\Entities\Consultation;
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
            'consultation_id' => Consultation::factory(),
            'payment_id' => Payment::factory(),
            'discount_amount' => $this->faker->optional()->randomFloat(2, 1, 100),
        ];
    }
}
