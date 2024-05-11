<?php

namespace App\Models;

use App\Events\VacancyDeleted;
use App\Http\Resources\AssessmentCriteriaResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'status',
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at',
    ];

    protected $dispatchesEvents = [
        'deleted' => VacancyDeleted::class,
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

    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
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

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->tz(config('app.timezone'))->format('Y-m-d H:i:s'),
        );
    }

    protected function startAt()
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->tz(config('app.timezone'))->format('Y-m-d H:i:s'),
        );
    }

    protected function endAt()
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->tz(config('app.timezone'))->format('Y-m-d H:i:s'),
        );
    }

    public function isAssessmentExist(): bool
    {
        return $this->assessments->count() > 0;
    }

    public function isAssessmentCriteriaExist(): bool
    {
        $complete = true;

        foreach($this->assessments as $assessment){
            if($assessment->criterias->count() == 0){
                $complete = false;
            }
        }
        return $complete;
    }

    public function statusName(): Attribute
    {
        return Attribute::make(
            get: function() {
                if($this->status == 1){
                    return 'Published';
                }

                if($this->status == 2){
                    return 'Deleted';
                }

                if(! $this->isAssessmentExist()){
                    return 'Assessment incomplete';
                }

                if(! $this->isAssessmentCriteriaExist()){
                    return 'Criteria incomplete';
                }

                return 'Draft';
            }
        );
    }

    public function isAssessmentWeightValid()
    {
        return $this->assessments->sum('weight') === 100;
    }

    public function isAssessmentCriteriaWeightValid()
    {
        $valid = true;
        foreach($this->assessments as $item){
            if($item->criterias->sum('weight') !== 100){
                $valid = false;
            }
        }

        return $valid;
    }

    public function isValid(): bool
    {
        return $this->isAssessmentExist() && $this->isAssessmentCriteriaExist() && $this->isAssessmentWeightValid() && $this->isAssessmentCriteriaWeightValid();
    }

    public function criteriaNeedInput()
    {
        $collection = collect();
        foreach($this->assessments()->get() as $assessment){
            foreach($assessment->criterias as $criteria){
                if($criteria->criteria->reference_type == 2){
                    $collection->push($criteria->criteria);
                }
            }
        }
        return $collection;
    }

    public function isApplied(): bool
    {
        if($this->applicants->where('user_id', auth()->user()->id)->first()){
            return true;
        }

        return false;
    }
}
