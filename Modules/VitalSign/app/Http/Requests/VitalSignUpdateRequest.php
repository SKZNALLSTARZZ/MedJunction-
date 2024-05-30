<?php

namespace Modules\VitalSign\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VitalSignUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'body_temperature' => 'required|numeric|min:30|max:45',
            'pulse_rate' => 'required|integer|min:30|max:200',
            'respiration_rate' => 'required|integer|min:10|max:60',
            'blood_pressure' => 'required|string|max:255',
            'oxygen_saturation' => 'required|integer|min:0|max:100',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
