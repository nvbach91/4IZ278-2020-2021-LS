<?php

namespace App\Http\Controllers;

class CheckoutController extends Controller {
    public function index($total) {
        $totalPrice = number_format($total, 2, ',', ' ');
        return view('pages.checkout', ['total' => $totalPrice]);
    }
}
