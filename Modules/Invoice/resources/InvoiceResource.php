<?php
namespace Modules\Invoice\resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'due_date' => Carbon::parse($this->created_at)->addMonth()->format('Y-m-d'),
            'patient' => [
                'name' => $this->consultation->appointment->patient->name,
                'phone' => $this->consultation->appointment->patient->phone,
            ],
            'payment' => [
                'amount' => $this->payment->amount,
            ],
        ];
    }
}
