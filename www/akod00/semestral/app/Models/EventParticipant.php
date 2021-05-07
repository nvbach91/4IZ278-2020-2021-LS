<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * @method static Builder where(string $string, string $id)
 * @method static create(array $array)
 * @property int participant_id
 * @property string event_id
 * @property int id
 */
class EventParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        "participant_id",
        "event_id"
    ];

    public function participant(): BelongsTo {
        return $this->belongsTo(User::class, "participant_id", "id");
    }

    public function event(): BelongsTo {
        return $this->belongsTo(Event::class, "event_id", "id");
    }
}
