<?php

namespace Modules\User\Database\Factories;

use Illuminate\Support\Str;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'role' => $this->faker->randomElement(['patient', 'doctor', 'nurse', 'pharmacist', 'receptionist']),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'img_url' => $this->faker->url,
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
