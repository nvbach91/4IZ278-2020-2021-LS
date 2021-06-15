<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Reservation
 *
 * @property int $id
 * @property Carbon $date_from
 * @property Carbon $date_to
 * @property int $user_id
 * @property int $service_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Service $service
 * @property-read User $user
 * @method static Builder|Reservation newModelQuery()
 * @method static Builder|Reservation newQuery()
 * @method static Builder|Reservation query()
 * @method static Builder|Reservation whereCreatedAt($value)
 * @method static Builder|Reservation whereDateFrom($value)
 * @method static Builder|Reservation whereDateTo($value)
 * @method static Builder|Reservation whereId($value)
 * @method static Builder|Reservation whereServiceId($value)
 * @method static Builder|Reservation whereUpdatedAt($value)
 * @method static Builder|Reservation whereUserId($value)
 * @mixin Eloquent
 */
class Reservation extends BaseModel
{


    protected $fillable = [
        'date_from',
        'date_to',
        'user_id',
        'service_id',
    ];

    protected $casts = [
        'date_from' => 'datetime',
        'date_to' => 'datetime',
    ];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }


}
