<?php

namespace App\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAssessmentCriteriaRequest extends FormRequest
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
            'vacancy_assessment_id' => 'required',
            'criteria_id' => [
                'required',
                Rule::unique('assessment_criterias')->ignore($this->id)->where(fn (Builder $query) => $query->where('vacancy_assessment_id', $this->vacancy_assessment_id)->where('deleted_at', '=', null))
            ],
            'treshold' => 'required|numeric|min:0|max:100',
            'weight' => 'required|numeric|min:0|max:100',
            'publish' => 'boolean',
            'reference' => 'array'
        ];
    }
}
