<?php

namespace Modules\Service\Database\Factories;

use Modules\Service\Entities\Service;
use Modules\Speciality\Entities\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Service::class;

    public function definition(): array
    {
        $specialities = Speciality::all();
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'speciality_id' => $specialities->random()->id,
        ];
    }
}
