<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Service
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $duration
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|OpeningHours[] $openingHours
 * @property-read int|null $opening_hours_count
 * @property-read Collection|Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @property-read User $user
 * @method static Builder|Service newModelQuery()
 * @method static Builder|Service newQuery()
 * @method static Builder|Service query()
 * @method static Builder|Service whereCreatedAt($value)
 * @method static Builder|Service whereDescription($value)
 * @method static Builder|Service whereDuration($value)
 * @method static Builder|Service whereId($value)
 * @method static Builder|Service whereName($value)
 * @method static Builder|Service whereUpdatedAt($value)
 * @method static Builder|Service whereUserId($value)
 * @mixin Eloquent
 */
class Service extends BaseModel
{

    protected $fillable = [
        "name",
        "description",
        "duration",
    ];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);

    }

    /**
     * @return HasMany
     */

    public function openingHours(): HasMany
    {
        return $this->hasMany(OpeningHours::class);

    }


}
