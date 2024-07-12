<?php
namespace Modules\User\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'token' => $this->token,
            'role' => $this->role,
            'image' => $this->image,
            'address' => $this->address,
            'patientId' => $this->patientId,
        ];
    }
}
