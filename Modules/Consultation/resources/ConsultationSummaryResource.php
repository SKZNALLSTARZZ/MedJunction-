<?php
namespace Modules\Consultation\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationSummaryResource extends JsonResource
{
    public function toArray($request)
    {
        $treatmentPrice = optional($this->treatment)->price ?? 0;
        $medicinePrices = $this->prescription ? $this->prescription->medicines->sum('price') : 0;
        $totalPrice = $treatmentPrice + $medicinePrices;

        return [
            'Date' => $this->appointment->date ?? null,
            'Complains' => $this->complains,
            'Diagnosis' => $this->diagnosis->diagnosis_description ?? null,
            'Treatments' => optional($this->treatment)->name,
            'Prescription' => $this->prescription ? $this->prescription->medicines->pluck('name') : [],
            'Price' => $totalPrice,
        ];
    }
}
