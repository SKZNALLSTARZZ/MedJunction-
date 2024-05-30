<?php

namespace Modules\Consultation\Database\Factories;

use Modules\Nurse\Entities\Nurse;
use Modules\Doctor\Entities\Doctor;
use Modules\Invoice\Entities\Invoice;
use Modules\Patient\Entities\Patient;
use Modules\Service\Entities\Service;
use Modules\Diagnosis\Entities\Diagnosis;
use Modules\Treatment\Entities\Treatment;
use Modules\VitalSign\Entities\VitalSign;
use Modules\Appointment\Entities\Appointment;
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
            'nurse_id' => Nurse::factory(),
            'appointment_id' => Appointment::factory(),
            'treatment_id' => Treatment::factory(),
            'diagnosis_id' => Diagnosis::factory(),
            'invoice_id' => Invoice::factory(),
            'vitalSigns_id' => VitalSign::factory(),
            'complains' => $this->faker->text,
            'pictures' => json_encode([$faker->imageUrl()]),
        ];
    }
}
