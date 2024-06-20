<?php
namespace Modules\Appointment\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'Date' => $this->created_at->toDateString(),
            'Patient' => [
                'name' => $this->patient->name,
                'phone' => $this->patient->phone,
            ],
            'Status' => $this->status,
            'Start_time' => $this->start_time? \Carbon\Carbon::parse($this->start_time)->format('H:i') : null,
            'End_time' => $this->end_time? \Carbon\Carbon::parse($this->end_time)->format('H:i') : null,
        ];
    }
}
