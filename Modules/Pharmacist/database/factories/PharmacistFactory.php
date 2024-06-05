<?php

namespace Modules\Pharmacist\Database\Factories;

use Modules\User\Entities\User;
use Modules\Pharmacist\Entities\Pharmacist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pharmacist>
 */
class PharmacistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pharmacist::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
