<?php

namespace Modules\Allergy\Database\Factories;

use Modules\Allergy\Entities\Allergy;
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

    protected $model = Allergy::class;

    public function definition(): array
    {
        $patients = Patient::all();
        return [
            'patient_id' => $patients->random()->id,
            'name' => $this->faker->word,
            'severity' => $this->faker->randomElement(['mild', 'moderate', 'severe']),
            'reaction' => $this->faker->sentence,
        ];
    }
}
