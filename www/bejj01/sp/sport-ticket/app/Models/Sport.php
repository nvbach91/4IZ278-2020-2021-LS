<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $table = 'sport';
    protected $primaryKey = 'sport_id';

    protected $fillable = [
        'sport_name'
    ];

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
