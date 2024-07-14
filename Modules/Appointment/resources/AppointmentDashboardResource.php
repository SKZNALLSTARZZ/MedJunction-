<?php
namespace Modules\Appointment\resources;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentDashboardResource extends JsonResource
{
    public function toArray($request)
    {
        $currentDateTime = Carbon::now();
        $appointmentDateTime = Carbon::parse($this->appointment_date . ' ' . $this->start_time);

        // Check if the appointment is in the future or past
        $timeDifference = $appointmentDateTime->diffForHumans($currentDateTime, [
            'parts' => 1, // Show only one part of the time difference
            'short' => true, // Use short units (e.g., '2 hrs')
            'syntax' => Carbon::DIFF_RELATIVE_TO_NOW, // Calculate relative to now
        ]);

            $formattedStartTime = Carbon::parse($this->start_time)->format('h:i A');
            $formattedEndTime = Carbon::parse($this->end_time)->format('h:i A');
        return [
            'id' => $this->id,
            'appointment_date' => $this->date,
            'start_time' => $formattedStartTime ,
            'end_time' => $formattedEndTime,
            'status' => $this->status,
            'patient_name' => $this->patient->name,
            'time_difference' => $timeDifference,
            // Add other fields as needed
        ];
    }
}
