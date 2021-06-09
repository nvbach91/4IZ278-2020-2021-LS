<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Place - Place table
 * @package App\Models
 */
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
