<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceStation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gps',
        'img',
        'galaxy_id'
    ];

    public function galaxy() {
        return $this->belongsTo(Galaxy::class);
    }
}
