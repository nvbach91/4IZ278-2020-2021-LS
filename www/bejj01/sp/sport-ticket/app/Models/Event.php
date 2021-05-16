<?php

namespace App\Models;

use Decimal\Decimal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';
    protected $primaryKey = 'event_id';

    protected $fillable = [
        'event_name',
        'start_date',
        'end_date',
        'img',
        'price',
        'competition',
        'capacity',
        'description',
        'sport_id',
        'place_id'
    ];

    protected $dates = ['start_date', 'end_date'];

    public function sport() {
        return $this->belongsTo(Sport::class, 'sport_id');
    }

    public function place() {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function formatPrice($price) {
        return number_format($price, 2, ',', ' ');
    }

    public function formatDate($date) {
        return $date->format('j. n. Y');
    }
}
