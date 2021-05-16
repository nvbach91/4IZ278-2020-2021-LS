<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $table = 'place';
    protected $primaryKey = 'place_id';

    protected $fillable = [
        'place_name',
        'city',
        'country'
    ];
}
