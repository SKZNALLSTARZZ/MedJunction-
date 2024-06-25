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
        if (Department::count() === 0) {
            Department::factory()->count(3)->create();
        }

        $specialtiesByDepartment = [
            'Cardiology' => [
                'Interventional Cardiology',
                'Electrophysiology',
                'Heart Failure Management'
            ],
            'Oncology' => [
                'Medical Oncology',
                'Radiation Oncology',
                'Surgical Oncology'
            ],
            'Orthopedics' => [
                'Joint Replacement',
                'Sports Medicine',
                'Spine Surgery'
            ],
        ];

        $department = Department::inRandomOrder()->first();

        $specialtyName = $this->faker->randomElement($specialtiesByDepartment[$department->name]);

        return [
            'name' => $specialtyName,
            'description' => $this->faker->sentence,
            'department_id' => $department->id,
        ];
    }
}
