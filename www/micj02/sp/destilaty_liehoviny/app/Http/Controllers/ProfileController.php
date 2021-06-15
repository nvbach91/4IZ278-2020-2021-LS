<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends BaseCartController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        $user =  auth()->user();
        $user_address = $user->address;
        $cart = $this->get_or_create_cart($request);
        return view('profile.show', compact(['user', 'user_address', 'cart']));
    }

    public function edit(Request $request)
    {
        $cart = $this->get_or_create_cart($request);
        $user =  auth()->user();
        $user_address = $user->address;
        return view('profile.edit', compact(['user', 'user_address', 'cart']));
    }

    public function update(Request $request)
    {
        $address_data = $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['email', 'required', 'max:255'],
            'address_1' => ['required', 'max:255'],
            'address_2' => ['', 'max:255'],
            'phone_number' => ['', 'max:255'],
            'city' => ['required', 'max:255'],
            'zipcode' => ['required', 'max:255'],
            'country' => ['required', 'integer'],
            'terms' => ['required'],
        ]);
        unset( $address_data['terms']);
        $user =  auth()->user();
        $user_address = $user->address;
        if ($user_address){
            $user->address()->update($address_data);
        } else {
            $user->address()->create($address_data);
        }

        return redirect("/profile/{$user->id}");
    }

}
