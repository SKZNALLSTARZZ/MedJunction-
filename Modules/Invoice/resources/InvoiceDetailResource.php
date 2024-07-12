<?php
namespace Modules\Invoice\resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'due_date' => Carbon::parse($this->created_at)->addMonth()->format('Y-m-d'),
            'amount' => $this->payment->amount,
            'discount' => $this->discount_amount,
            'patient' => [
                'name' => $this->consultation->appointment->patient->name,
                'phone' => $this->consultation->appointment->patient->phone,
                'email' => $this->consultation->appointment->patient->user->email,
            ],
            'prescription' => $this->consultation->prescription->medicines->map(function($medicine) {
                return [
                    'medicine_name' => $medicine->name,
                    'price' => $medicine->price,
                    'quantity' => $medicine->pivot->quantity,
                ];
            }),
            'treatment' => [
                'name' => $this->consultation->appointment->treatment->name,
                'price' => $this->consultation->appointment->treatment->price,
            ],
        ];
    }
}
