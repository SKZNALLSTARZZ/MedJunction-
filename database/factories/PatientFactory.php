<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'user_id' => User::inRandomOrder()->first()->id,
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'blood_group' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'birthdate' => $this->faker->date(),
            'height' => $this->faker->randomFloat(2, 100, 250),
            'weight' => $this->faker->randomFloat(2, 20, 200),
            'age' => $this->faker->numberBetween(1, 100),
            'allergies' => $this->faker->text,
            'habits' => $this->faker->text,
            'medical_history' => $this->faker->text,
        ];
    }
}
