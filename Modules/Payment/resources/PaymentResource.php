<?php

namespace Modules\Payment\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'payment_type' => $this->payment_type,
            'remarks' => $this->remarks,
            'amount' => $this->amount,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'name' => $this->name,
            'phone' => $this->phone,
            'img_url' => $this->img_url,

        ];
    }
}
