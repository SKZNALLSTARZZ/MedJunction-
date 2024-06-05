<?php

namespace Modules\Treatment\Database\Factories;

use Modules\Service\Entities\Service;
use Modules\Treatment\Entities\Treatment;
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
    protected $model = Treatment::class;

    public function definition(): array
    {
        $services = Service::all();
        return [
            'service_id' => $services->random()->id,
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
