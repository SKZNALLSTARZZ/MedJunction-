<?php

namespace Modules\MedicinePrescription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicinePrescription\Entities\MedicinePrescription;


class MedicinePrescriptionFactory extends Factory
{
    protected $model = MedicinePrescription::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dosage' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1, 100),
            'instructions' => $this->faker->sentence,
        ];
    }
}

