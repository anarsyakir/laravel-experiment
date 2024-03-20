<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'vacancy' => new VacancyWithAssessmentResource($this->vacancy),
            'user' => new UserResource($this->user),
            'assessments' => ApplicantAssessmentResource::collection($this->assessments),
            'created_at' => $this->created_at,
            'id' => $this->id
        ];
    }
}
