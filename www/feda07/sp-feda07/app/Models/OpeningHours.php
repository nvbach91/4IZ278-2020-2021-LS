<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\OpeningHours
 *
 * @property int $id
 * @property Carbon $time_from
 * @property Carbon $time_to
 * @property int $day
 * @property int $service_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Service $service
 * @method static Builder|OpeningHours newModelQuery()
 * @method static Builder|OpeningHours newQuery()
 * @method static Builder|OpeningHours query()
 * @method static Builder|OpeningHours whereCreatedAt($value)
 * @method static Builder|OpeningHours whereDay($value)
 * @method static Builder|OpeningHours whereId($value)
 * @method static Builder|OpeningHours whereServiceId($value)
 * @method static Builder|OpeningHours whereTimeFrom($value)
 * @method static Builder|OpeningHours whereTimeTo($value)
 * @method static Builder|OpeningHours whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OpeningHours extends BaseModel
{
    protected $fillable = [
        'time_from',
        'time_to',
        'day',
        'service_id'
    ];

    protected $casts = [
        "time_from" => "datetime",
        "time_to" => "datetime"
    ];

    /**
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

}
