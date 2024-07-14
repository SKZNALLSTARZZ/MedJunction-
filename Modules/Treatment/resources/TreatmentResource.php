<?php

namespace Modules\Treatment\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'date' => Carbon::parse($this->created_at)->format('M d, Y'),
            'price' => $this->price,
            'name' => $this->name,
            'speciality' => $this->service->speciality->name,
            'service' => $this->service->title,

        ];
    }

}
