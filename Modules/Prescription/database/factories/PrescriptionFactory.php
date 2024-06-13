<?php

namespace Modules\Prescription\Database\Factories;

use Modules\Consultation\Entities\Consultation;
use Modules\Prescription\Entities\Prescription;
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
    protected $model = Prescription::class;

    public function definition(): array
    {
        return [
            'dosage' => $this->faker->numberBetween(0, 10),
            'quantity' => $this->faker->numberBetween(0, 5),
            'instructions' => $this->faker->sentence,
            'amount' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
