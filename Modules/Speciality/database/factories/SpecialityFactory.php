<?php

namespace Modules\Speciality\Database\Factories;


use Modules\Department\Entities\Department;
use Modules\Speciality\Entities\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\[=Speciality]>
 */
class SpecialityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Speciality::class;

    public function definition(): array
    {
        $departments = Department::all();
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'department_id' => $departments->random()->id,
        ];
    }
}
