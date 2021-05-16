<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function edit(User $user)
    {
        $this->authorize('update', $user->user_address);

        return view('address.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->user_address);

//        $data = request()->validate([
//            'key' => 'value',
//        ]);

        return redirect("/{$user->id}/address/edit");
    }
}
