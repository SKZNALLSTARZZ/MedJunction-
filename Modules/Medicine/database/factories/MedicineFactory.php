<?php

namespace Modules\Medicine\Database\Factories;



use Modules\Medicine\Entities\Medicine;
use Modules\Pharmacist\Entities\Pharmacist;
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
    protected $model = Medicine::class;

    public function definition(): array
    {
        $pharmacists = Pharmacist::all();
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
            'inStock' => $this->faker->boolean,
            'measure' => $this->faker->randomElement(['Tablet', 'mg', 'ml', 'Drop', 'tsp', 'tbsp', 'Spray', 'Patch', 'Inhaler']),
            'pharmacist_id' => $pharmacists->random()->id,
        ];
    }
}
