<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Ticket - Ticket table
 * @package App\Models
 */
class Ticket extends Model
{
    use HasFactory;

    protected $table = 'ticket';
    protected $primaryKey = 'ticket_id';

    protected $fillable = [
        'user_id',
        'event_id',
        'sector',
        'seat'
    ];

    /**
     * Which event is ticket for
     * @return BelongsTo
     */
    public function event(): BelongsTo {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Which user has bought ticket
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
