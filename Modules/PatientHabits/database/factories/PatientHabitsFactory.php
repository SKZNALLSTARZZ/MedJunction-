<?php

namespace Modules\PatientHabits\Database\Factories;

use Modules\PatientHabits\Entities\PatientHabits;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientHabitsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\PatientHabits\Entities\PatientHabits::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

