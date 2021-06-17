<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferUser extends Model
{
    use HasFactory;

    protected $fillable = ['ID_USER', 'ID_OFFER'];
    protected $table = 'offer_user';
    
    //const CREATED_AT = 'DATE_CREATED';
    //const UPDATED_AT = 'DATE_CREATED';

    //protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
