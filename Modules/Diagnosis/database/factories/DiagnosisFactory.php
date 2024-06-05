<?php

namespace Modules\Diagnosis\Database\Factories;

use Modules\Diagnosis\Entities\Diagnosis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diagnosis>
 */
class DiagnosisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Diagnosis::class;

    public function definition(): array
    {
        return [
            'diagnosis_code' => $this->faker->unique()->regexify('[A-Z0-9]{5}'),
            'diagnosis_description' => $this->faker->sentence,
        ];
    }
}
