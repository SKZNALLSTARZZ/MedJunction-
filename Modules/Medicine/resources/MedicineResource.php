<?php
namespace Modules\Medicine\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicineResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'status' => $this->status,
            'price' => $this->price,
            'measure' => $this->measure,
            'instock' => $this->inStock,
        ];
    }
}
