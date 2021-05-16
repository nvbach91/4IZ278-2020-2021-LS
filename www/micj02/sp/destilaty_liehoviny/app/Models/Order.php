<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function order_address()
    {
        return $this->hasOne(OrderAddress::class);
    }

    public function user()
    {
        return$this->belongsTo(User::class);
    }

    public function liquors()
    {
        return $this->belongsToMany(Liquor::class);
    }
}
