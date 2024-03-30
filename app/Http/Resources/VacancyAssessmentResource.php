<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacancyAssessmentResource extends JsonResource
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
            'sequence' => $this->sequence,
            'treshold' => $this->treshold,
            'weight' => $this->weight,
            'count_by_average' => $this->count_by_average,
            'assessment' => new AssessmentResource($this->assessment),
            'criterias' => AssessmentCriteriaResource::collection($this->criterias),
            'criterias_weight' => $this->criterias->sum('weight'),
        ];
    }
}
