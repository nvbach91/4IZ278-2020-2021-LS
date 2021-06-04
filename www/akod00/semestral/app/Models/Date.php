<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property datetime datetime
 * @method static where(string $string, string $id)
 * @method static create(string[] $array)
 * @method static find(mixed $date)
 */
class Date extends Model
{
    use HasFactory;

    protected $fillable = [
        "datetime",
        "event_id"
    ];

    public function event(): BelongsTo {
        return $this->belongsTo(Event::class, "event_id", "id");
    }

    public function dateParticipants(): HasMany {
        return $this->hasMany(ParticipantAvailable::class);
    }
}
