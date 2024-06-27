<?php
namespace Modules\Consultation\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationResource extends JsonResource
{
    public function toArray($request)
    {
        $prescriptions = $this->prescription ? $this->prescription->medicines->map(function ($medicine) {
            $quantity = $medicine->pivot->quantity ?? 0;
            $price = $medicine->price;
            $amount = $price * $quantity;

            return [
                'name' => $medicine->name,
                'price' => $price,
                'dosage' => $medicine->pivot->dosage ?? null,
                'quantity' => $quantity,
                'instructions' => $medicine->pivot->instructions ?? null,
                'amount' => number_format($amount, 2),
            ];
        }) : [];

        $treatment = $this->appointment && $this->appointment->treatment ? [
            'name' => $this->appointment->treatment->name,
            'price' => $this->appointment->treatment->price,
        ] : null;

        return [
            'Complains' => $this->complains,
            'Date' => $this->appointment->date ? \Carbon\Carbon::parse($this->appointment->date)->format('dM Y') : null,
            'Diagnosis' => $this->diagnosis->diagnosis_description ?? null,
            'Vital_signs' => [
                'Temperature: ' => optional($this->vitalSign)->body_temperature,
                'Pulse Rate: ' => optional($this->vitalSign)->pulse_rate,
                'Respiration Rate: ' => optional($this->vitalSign)->respiration_rate,
                'Bloodc Pressure: ' => optional($this->vitalSign)->blood_pressure,
            ],
            'Prescription' => $prescriptions,
            'Treatment' => $treatment,
            'Pictures' => $this->pictures,
        ];
    }
}
