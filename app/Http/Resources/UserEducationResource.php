<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserEducationResource extends JsonResource
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
            'education' => new EducationResource($this->education),
            'major' => new MajorResource($this->major),
            'school' => $this->school,
            'gpa' => $this->gpa,
            'year' => $this->year,
        ];
    }
}
