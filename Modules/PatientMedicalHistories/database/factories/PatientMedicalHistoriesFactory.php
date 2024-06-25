<?php

namespace Modules\PatientMedicalHistories\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PatientMedicalHistories\Entities\PatientMedicalHistories;

class PatientMedicalHistoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\PatientMedicalHistories\Entities\PatientMedicalHistories::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

