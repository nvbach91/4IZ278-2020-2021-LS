<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function edit(Request $request)
    {
        $session = Session::where('id', $request->session()->getId())->first();
        $cart = $session->cart;
        if (!$cart) {
            $cart = $session->cart()->create();
        }
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
