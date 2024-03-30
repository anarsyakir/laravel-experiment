<?php

namespace App\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVacancyAssessmentRequest extends FormRequest
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
            'vacancy_id' => 'required',
            'assessment_id' => [
                'required',
                Rule::unique('vacancy_assessments')->ignore($this->id)->where(fn (Builder $query) => $query->where('vacancy_id', $this->vacancy_id)->where('deleted_at', '=', null))
            ],
            'sequence' => 'required|numeric',
            'treshold' => 'required|numeric|min:0|max:100',
            'weight' => 'required|numeric|min:0|max:100',
            'count_by_average' => 'boolean',
        ];
    }
}
