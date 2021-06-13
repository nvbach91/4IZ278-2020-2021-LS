<?php

namespace App\Http\Controllers;

use App\Models\Liquor;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends BaseCartController
{

    public function add_to_cart(Request $request, Liquor $liquor)
    {
        $cart = $this->get_or_create_cart($request);
        if ($cart->liquors->contains($liquor->id)) {
            $quantity = $cart->liquors()->find($liquor->id)->pivot->quantity + 1;
            $cart->liquors()->updateExistingPivot($liquor->id, compact('quantity'));
            return $quantity;
        } else {
            $cart->liquors()->attach($liquor->id, ['quantity' => 1]);
        }
        return $cart->total_quantity();
    }

    public function remove_from_cart(Request $request, Liquor $liquor)
    {
        $cart = $this->get_or_create_cart($request);
        $cart->liquors()->detach($liquor->id);
        return $cart->total_quantity();
    }

    public function edit(Request $request)
    {
        $cart = $this->get_or_create_cart($request);
        return view('cart.edit', compact('cart'));
    }

    public function update(User $user)
    {
//        $this->authorize('update', $user->cart);

//        $data = request()->validate([
//            'key' => 'value',
//        ]);

        return redirect("/{$user->id}/cart/edit");
    }
}
