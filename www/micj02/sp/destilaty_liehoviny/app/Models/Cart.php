<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $fillable = ['session_id'];

    public function total_quantity()
    {
        return array_sum($this->liquors()->pluck('quantity')->toArray());
    }

    public function total_price()
    {
        $quantity_price_array = $this->liquors()->get(['quantity', 'price'])->toArray();
        $total_price = 0;
        foreach($quantity_price_array as $qp)
        {
            $total_price = $total_price + $qp['quantity'] * $qp['price'];
        }
        return $total_price;
    }

    public function session()
    {
        return$this->belongsTo(Session::class);
    }

    public function liquors()
    {
        return $this->belongsToMany(Liquor::class)->withPivot('quantity');
    }
}
