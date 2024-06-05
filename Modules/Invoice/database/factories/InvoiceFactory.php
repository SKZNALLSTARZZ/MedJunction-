<?php

namespace Modules\Invoice\Database\Factories;


use Modules\Invoice\Entities\Invoice;
use Modules\Payment\Entities\Payment;
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
    protected $model = Invoice::class;

    public function definition(): array
    {
        $payments = Payment::all();
        return [
            'payment_id' => $payments->random()->id,
            'discount_amount' => $this->faker->optional()->randomFloat(2, 1, 100),
        ];
    }
}
