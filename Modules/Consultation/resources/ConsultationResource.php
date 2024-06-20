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

        return [
            'Complains' => $this->complains,
            'Date' => $this->appointment->date ? \Carbon\Carbon::parse($this->appointment->date)->format('dM Y') : null,
            'Diagnosis' => $this->diagnosis->diagnosis_description ?? null,
            'Treatments' => optional($this->treatment)->name,
            'Vital_signs' => [
                'Temperature: ' => optional($this->vitalSign)->body_temperature,
                'Pulse Rate: ' => optional($this->vitalSign)->pulse_rate,
                'Respiration Rate: ' => optional($this->vitalSign)->respiration_rate,
                'Bloodc Pressure: ' => optional($this->vitalSign)->blood_pressure,
            ],
            'Prescription' => $prescriptions,
            'Price' => number_format($totalPrice, 2),
            'Pictures' => $this->pictures,
        ];
    }
}
