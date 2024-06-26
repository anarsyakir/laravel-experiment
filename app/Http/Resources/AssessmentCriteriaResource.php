<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentCriteriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'criteria' => new CriteriaResource($this->criteria),
            'reference' => $this->when($this->reference, Json::decode($this->reference, true), $this->reference),
            'treshold' => $this->treshold,
            'weight' => $this->weight,
            'publish' => $this->publish,
            'id' => $this->id,
            'vacancy_assessment_id' => $this->vacancy_assessment_id,
        ];
    }
}
