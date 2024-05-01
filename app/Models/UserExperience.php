<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserExperience extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $fillable = [
        'user_id',
        'company',
        'position_id',
        'description',
        'start_at',
        'end_at',
    ];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
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
}
