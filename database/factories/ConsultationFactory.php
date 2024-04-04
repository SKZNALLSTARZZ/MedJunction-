<?php

namespace Database\Factories;

use App\Models\Nurse;
use App\Models\Doctor;
use App\Models\Prescription;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\[=Consultation]>
 */
class ConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'remarks' => $this->faker->text,
            'doctor_id' => Doctor::factory(),
            'nurse_id' => Nurse::factory(),
            'patient_id' => Patient::factory(),
            'appointment_id' => Appointment::factory(),
        ];
    }
}
