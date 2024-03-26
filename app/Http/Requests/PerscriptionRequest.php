<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'state' => 'required|string|max:255',
            'symptom' => 'required|string|max:255',
            'advice' => 'required|string|max:255',
            'medicine' => 'required|string|max:255',
            'validity' => 'required|string|max:255',
        ];
    }
}
