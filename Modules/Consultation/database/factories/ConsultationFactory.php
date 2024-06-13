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
use Modules\Prescription\Entities\Prescription;
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

    private function getRandomId($collection, &$usedIds)
    {
        $availableItems = $collection->whereNotIn('id', $usedIds);
        if ($availableItems->isEmpty()) {
            if ($collection->isEmpty()) {
                throw new InvalidArgumentException("No items available to select from.");
            }
            return $collection->random()->id;
        }
        return $availableItems->random()->id;
    }

    public function definition(): array
    {
        static $usedAppointmentIds = [];
        static $usedDiagnosisIds = [];
        static $usedInvoiceIds = [];
        static $usedPrescriptionIds = [];

        $nurses = Nurse::all();
        $appointments = Appointment::where('is_consulted', true)->get();
        $treatments = Treatment::all();
        $diagnoses = Diagnosis::all();
        $invoices = Invoice::all();
        $vitalSigns = VitalSign::all();
        $prescriptions = Prescription::all();

        $appointmentId = $this->getRandomId($appointments, $usedAppointmentIds);
        $diagnosisId = $this->getRandomId($diagnoses, $usedDiagnosisIds);
        $invoiceId = $this->getRandomId($invoices, $usedInvoiceIds);
        $prescriptionId = $this->getRandomId($prescriptions, $usedPrescriptionIds);

        $usedAppointmentIds[] = $appointmentId;
        $usedDiagnosisIds[] = $diagnosisId;
        $usedInvoiceIds[] = $invoiceId;
        $usedPrescriptionIds[] = $prescriptionId;

        return [
            'nurse_id' => $nurses->random()->id,
            'appointment_id' => $appointmentId,
            'treatment_id' => $treatments->random()->id,
            'diagnosis_id' => $diagnosisId,
            'invoice_id' => $invoiceId,
            'vital_sign_id' => $vitalSigns->random()->id,
            'prescription_id' => $prescriptionId,
            'complains' => $this->faker->text,
            'pictures' => json_encode([$this->faker->imageUrl()]),
        ];
    }
}
