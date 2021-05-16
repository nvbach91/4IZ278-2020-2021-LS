<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function edit(User $user)
    {
        $this->authorize('update', $user->cart);

        return view('cart.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->cart);

//        $data = request()->validate([
//            'key' => 'value',
//        ]);

        return redirect("/{$user->id}/cart/edit");
    }
}
