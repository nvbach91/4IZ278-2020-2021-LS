<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class BaseCartController extends Controller
{

    public function get_or_create_cart(Request $request)
    {
        $session = Session::where('id', $request->session()->getId())->first();
        if ($session) {
            $cart = $session->cart;
            if (!$cart) {
                $cart = $session->cart()->create();
            }
            return $cart;
        }
        return null;
    }

}
