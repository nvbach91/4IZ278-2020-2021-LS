<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function event() {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
