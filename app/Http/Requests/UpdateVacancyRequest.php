<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVacancyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required',
            'company_id' => 'required',
            'position_id' => 'required',
            'description' => 'required',
            'max_applicant' => 'required',
            'start_at' => 'date_format:Y-m-d',
            'end_at' => 'date_format:Y-m-d',
            'status' => 'boolean',
        ];
    }
}
