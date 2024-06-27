<?php
namespace Modules\Patient\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'blood_group' => $this->blood_group,
            'birthdate' => $this->birthdate,
            'height' => $this->height,
            'weight' => $this->weight,
            'age' => $this->age,
            'img_data' => $this->img_data,
            'user' => [
                'id' => $this->user->id,
                'email' => $this->user->email,
                'img_url' => $this->user->img_url,
            ],
            'habits' => $this->habits->map(function ($habit) {
                return [
                    'type' => $habit->type,
                ];
            }),
            'allergies' => $this->allergies->map(function ($allergy) {
                return [
                    'name' => $allergy->name,
                ];
            }),
            'medical_histories' => $this->medicalHistories->map(function ($medicalHistory) {
                return [
                    'medical_condition' => $medicalHistory->medical_condition,
                ];
            }),
        ];
    }
}
