<?php

namespace App\Models;

use App\Http\Resources\AssessmentCriteriaResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacancy extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $fillable = [
        'company_id',
        'position_id',
        'description',
        'max_applicant',
        'start_at',
        'end_at',
    ];

    protected $hidden = [
        'company_id',
        'position_id',
        'max_applicant',
        'start_at',
        'end_at',
        'created_at',
        'deleted_at',
        'updated_at',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(VacancyAssessment::class);
    }

    public function publishedCriteria()
    {
        $collection = collect();
        foreach($this->assessments()->get() as $assessment){
            foreach($assessment->criterias()->where('publish', 1)->get() as $published){
                $collection->push(new AssessmentCriteriaResource($published));
            }
        }
        return $collection;
    }
}
