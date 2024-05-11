<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacancyApplyResource extends JsonResource
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
            'criteriaNeedInput' => $this->criteriaNeedInput(),
        ];
    }
}
