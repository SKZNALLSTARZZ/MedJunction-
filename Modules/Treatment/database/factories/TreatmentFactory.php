<?php

namespace Modules\Treatment\Database\Factories;

use Modules\Service\Entities\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatment>
 */
class TreatmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_id' => Service::factory(),
            'name' => $faker->word,
            'description' => $faker->sentence,
            'price' => $faker->randomFloat(2, 10, 500),
        ];
    }
}
