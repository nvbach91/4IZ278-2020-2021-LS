<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galaxy extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'size',
        'img'
    ];

    public function spaceStations() {
        $this->hasMany(SpaceStation::class);
    }
}
