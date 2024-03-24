<?php

namespace App\Http\Resources;

use App\Models\Criteria;
use App\Models\Vacancy;
use App\Models\VacancyAssessment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'company' => new CompanyResource($this->company),
            'position' => new PositionResource($this->position),
            'publishedCriteria' => $this->publishedCriteria(),
            'created_at' => $this->created_at,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'max_applicant' => $this->max_applicant,
            'assessments' => new VacancyAssessmentCollection($this->assessments)
        ];
    }
}
