<?php

namespace Modules\Receptionist\Database\Factories;

use Modules\User\Entities\User;
use Modules\Receptionist\Entities\Receptionist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receptionist>
 */
class ReceptionistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Receptionist::class;

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
