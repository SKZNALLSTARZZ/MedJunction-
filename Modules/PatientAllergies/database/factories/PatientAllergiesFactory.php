<?php

namespace Modules\PatientAllergies\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PatientAllergies\Entities\PatientAllergies;

class PatientAllergiesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\PatientAllergies\Entities\PatientAllergies::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

