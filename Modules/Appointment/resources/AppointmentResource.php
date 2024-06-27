<?php
namespace Modules\Appointment\resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'Date' => Carbon::parse($this->created_at)->format('M d, Y'),
            'Patient' => [
                'name' => $this->patient->name,
                'phone' => $this->patient->phone,
            ],
            'Doctor' => [
                'name' => $this->doctor->name,
            ],
            'Status' => $this->status,
            'Start_time' => $this->start_time,
            'End_time' => $this->end_time,
            'Description' => $this->description,
            'Treatment' => $this->treatment->name,
        ];
    }
}
