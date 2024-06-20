<?php
namespace Modules\Consultation\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationResource extends JsonResource
{
    public function toArray($request)
    {
        $treatmentPrice = optional($this->treatment)->price ?? 0;
        $medicinePrices = optional($this->prescription)->amount ?? 0;
        $totalPrice = $treatmentPrice + $medicinePrices;

        $prescriptions = $this->prescription ? $this->prescription->medicines->map(function ($medicine) {
            return [
                'name' => $medicine->name,
                'dosage' => $medicine->pivot->dosage ?? null,
                'quantity' => $medicine->pivot->quantity ?? null,
                'instructions' => $medicine->pivot->instructions ?? null,
            ];
        }) : [];

        return [
            'Complains' => $this->complains,
            'Date' => $this->appointment->date ? \Carbon\Carbon::parse($this->appointment->date)->format('dM Y') : null,
            'Diagnosis' => $this->diagnosis->diagnosis_description ?? null,
            'Treatments' => optional($this->treatment)->name,
            'Vital_signs' => [
                'body_temperature' => optional($this->vitalSign)->body_temperature,
                'pulse_rate' => optional($this->vitalSign)->pulse_rate,
                'respiration_rate' => optional($this->vitalSign)->respiration_rate,
                'blood_pressure' => optional($this->vitalSign)->blood_pressure,
            ],
            'Prescription' => $prescriptions,
            'Price' => number_format($totalPrice, 2),
        ];
    }
}
