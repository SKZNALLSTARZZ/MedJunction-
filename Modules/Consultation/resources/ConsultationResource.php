<?php
namespace Modules\Consultation\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'complains' => $this->complains,
            'date' => $this->appointment->date ?? null,
            'diagnosis' => $this->diagnosis->diagnosis_description ?? null,
            'treatments' => [
                    'name' => optional($this->treatment)->name,
                    'price' => optional($this->treatment)->price,
                ],
            'vital_signs' => [
                'body_temperature' => optional($this->vitalSign)->body_temperature,
                'pulse_rate' => optional($this->vitalSign)->pulse_rate,
                'respiration_rate' => optional($this->vitalSign)->respiration_rate,
                'blood_pressure' => optional($this->vitalSign)->blood_pressure,
            ],
            'prescriptions' => $this->prescription ? $this->prescription->medicines->map(function ($medicine) {
                return [
                    'medicine_name' => $medicine->name,
                    'price' => $medicine->price,
                ];
            }) : [],
        ];
    }
}
