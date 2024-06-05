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
use Modules\Consultation\Entities\Consultation;
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
    protected $model = Consultation::class;

    public function definition(): array
    {
        $nurses = Nurse::all();
        $appointments = Appointment::all();
        $treatments = Treatment::all();
        $diagnoses = Diagnosis::all();
        $invoices = Invoice::all();
        $vitalSigns = VitalSign::all();

        return [
            'nurse_id' => $nurses->random()->id,
            'appointment_id' => $appointments->random()->id,
            'treatment_id' => $treatments->random()->id,
            'diagnosis_id' => $diagnoses->random()->id,
            'invoice_id' => $invoices->random()->id,
            'vital_signs_id' => $vitalSigns->random()->id,
            'complains' => $this->faker->text,
            'pictures' => json_encode([$this->faker->imageUrl()]),
        ];
    }
}
