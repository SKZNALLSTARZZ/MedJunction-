<?php

namespace Database\Factories;

use Modules\Patient\Entities\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Habit>
 */
class HabitFactory extends Factory
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
            'type' => $faker->randomElement(['smoking', 'drinking', 'exercise']),
            'frequency' => $faker->randomElement(['daily', 'weekly', 'monthly']),
            'duration' => $faker->randomElement(['short-term', 'long-term']),
        ];
    }
}
