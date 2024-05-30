<?php

namespace Modules\Diagnosis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiagnosisAddRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'diagnosis_code' => 'required|string|max:255|unique:diagnoses,diagnosis_code',
            'diagnosis_description' => 'required|string|max:255',
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
