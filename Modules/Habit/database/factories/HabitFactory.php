<?php

namespace Modules\Habit\Database\Factories;

use Modules\Habit\Entities\Habit;
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
    protected $model = Habit::class;

    public function definition(): array
    {
        $patients = Patient::all();
        return [
            'patient_id' => $patients->random()->id,
            'type' => $this->faker->randomElement(['smoking', 'drinking', 'exercise']),
            'frequency' => $this->faker->randomElement(['daily', 'weekly', 'monthly']),
            'duration' => $this->faker->randomElement(['short-term', 'long-term']),
        ];
    }
}
