<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacancyAssessmentNoCriteria extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sequence' => $this->sequence,
            'assessment' => new AssessmentResource($this->assessment),
            'id' => $this->id,
        ];
    }
}
