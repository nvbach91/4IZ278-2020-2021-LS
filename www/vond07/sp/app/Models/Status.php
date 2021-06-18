<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Status extends Eloquent
{
    use HasFactory;

    protected $table = 'status';

    public function offer()
    {
        return $this->belongsTo('Offer', 'STATUS', 'ID');
    }
}
