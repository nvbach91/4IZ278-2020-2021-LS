<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Service
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $duration
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OpeningHours[] $openingHours
 * @property-read int|null $opening_hours_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reservation[] $reservation
 * @property-read int|null $reservation_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUserId($value)
 * @mixin \Eloquent
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

    public function reservation(): HasMany
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
