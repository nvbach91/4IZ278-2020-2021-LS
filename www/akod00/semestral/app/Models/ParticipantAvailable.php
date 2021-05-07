<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * @property int participant_id
 * @property int date_id
 * @property int state
 * @method static Builder where($a, $b)
 * @method static create(array $array)
 * @method static whereIn(string $string, $dates)
 */
class ParticipantAvailable extends Model
{
    use HasFactory;

    protected $fillable = [
        "state",
        "participant_id",
        "date_id"
    ];

    public function participant(): BelongsTo {
        return $this->belongsTo(User::class, "participant_id", "id");
    }

    public function date(): BelongsTo {
        return $this->belongsTo(Date::class, "date_id", "id");
    }
}
