<?php

namespace Modules\Department\Database\Factories;

use Modules\Department\Entities\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\[=Department]>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Department::class;

    protected static $seededNames = [];

    public function definition(): array
    {
        $names = ['Cardiology', 'Oncology', 'Orthopedics'];

        $availableNames = array_diff($names, static::$seededNames);

        $name = $this->faker->unique()->randomElement($availableNames);

        static::$seededNames[] = $name;

        return [
            'name' => $name,
            'description' => $this->faker->sentence,
        ];
    }
}
