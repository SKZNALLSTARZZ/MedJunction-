<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition(): array
    {
        $urls = [
            '/uploads/7294795.jpg',
            '/uploads/7309667.jpg',
            '/uploads/7309678.jpg',
            '/uploads/7309683.jpg',
            '/uploads/7309685.jpg',
            '/uploads/7309687.jpg',
            '/uploads/7309689.jpg',
            '/uploads/7309693.jpg',
            '/uploads/7309703.jpg',
            '/uploads/9334220.jpg',
        ];
        return [
            'type' => $this->faker->randomElement(['Patient', 'Doctor', 'Nurse', 'Pharmacist', 'Receptionist']),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'img_url' => $this->faker->randomElement($urls),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
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
