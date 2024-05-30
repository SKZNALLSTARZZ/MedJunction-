<?php

namespace Modules\Appointment\database\factories;

use Modules\Doctor\Entities\Doctor;
use Modules\Patient\Entities\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\[=Appointment]>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $startTime->format('Y-m-d'),
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
            'description' => $faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'approved', 'cancelled']),
            'doctor_id' => Doctor::factory(),
            'patient_id' => Patient::factory(),
            'is_consulted' => $faker->boolean,
        ];
    }
}
