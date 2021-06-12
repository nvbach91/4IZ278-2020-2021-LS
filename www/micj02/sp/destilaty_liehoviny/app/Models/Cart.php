<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $fillable = ['session_id', 'total_price'];

    public function session()
    {
        return$this->belongsTo(Session::class);
    }

    public function liquors()
    {
        return $this->belongsToMany(Liquor::class);
    }
}
