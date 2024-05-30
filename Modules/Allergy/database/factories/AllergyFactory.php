<?php

namespace Modules\Allergy\Database\Factories;

use Modules\Patient\Entities\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Allergy>
 */
class AllergyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'name' => $faker->word,
            'severity' => $faker->randomElement(['mild', 'moderate', 'severe']),
            'reaction' => $faker->sentence,
        ];
    }
}
