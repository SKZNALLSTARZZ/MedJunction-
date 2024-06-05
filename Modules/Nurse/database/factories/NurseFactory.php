<?php

namespace Modules\Nurse\Database\Factories;

use Modules\User\Entities\User;
use Modules\Nurse\Entities\Nurse;
use Modules\Speciality\Entities\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\[=Nurse]>
 */
class NurseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Nurse::class;

    public function definition(): array
    {
        $specialities = Speciality::all();
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'user_id' => User::inRandomOrder()->first()->id,
            'speciality_id' => $specialities->random()->id,
        ];
    }
}
