<?php

namespace Modules\Appointment\database\factories;

use Carbon\Carbon;
use Modules\Doctor\Entities\Doctor;
use Modules\Patient\Entities\Patient;
use Modules\Appointment\Entities\Appointment;
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
    protected $model = Appointment::class;

    public function definition(): array
    {
        $doctors = Doctor::all();
        $patients = Patient::all();

        $startTime = Carbon::instance($this->faker->dateTimeBetween('-1 week', '+1 week'));
        $endTime = (clone $startTime)->addHours($this->faker->numberBetween(1, 3));

        return [
            'date' => $startTime->format('Y-m-d'),
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'approved', 'cancelled']),
            'doctor_id' => $this->faker->randomElement($doctors)->id,
            'patient_id' => $this->faker->randomElement($patients)->id,
            'is_consulted' => $this->faker->boolean,
        ];
    }
}
