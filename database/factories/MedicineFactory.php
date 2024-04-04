<?php

namespace Database\Factories;

use App\Models\Pharmacist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
            'inStock' => $this->faker->numberBetween(0, 100),
            'measure' => $this->faker->randomElement(['Tablet', 'mg', 'ml', 'Drop', 'tsp', 'tbsp', 'Spray', 'Patch', 'Inhaler']),
            'pharmacist_id' => Pharmacist::factory(),
        ];
    }
}
