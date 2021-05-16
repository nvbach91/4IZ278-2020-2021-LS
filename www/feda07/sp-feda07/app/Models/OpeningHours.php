<?php

namespace App\Models;

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
 * @property-read \App\Models\Service $service
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours query()
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours whereTimeFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours whereTimeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OpeningHours extends BaseModel
{

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
