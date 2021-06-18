<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Offer extends Eloquent
{
    use HasFactory;

    protected $table = 'offer';
    
    const CREATED_AT = 'DATE_CREATED';
    const UPDATED_AT = 'DATE_CREATED';

    protected $guarded = [];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    //protected $dateFormat = 'U';

    public function status()
    {
        return $this->hasOne(Status::class, 'STATUS', $ID);
    }
}
