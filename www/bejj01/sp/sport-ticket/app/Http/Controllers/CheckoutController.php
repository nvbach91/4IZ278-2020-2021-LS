<?php

namespace App\Http\Controllers;

use App\Models\Event;

/**
 * Class CheckoutController - class handling actions for checkout
 * @package App\Http\Controllers
 */
class CheckoutController extends Controller {
    /**
     * Handles showing checkout page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $eventIds = session()->get('cart');
        $totalPrice = 0;

        if ($eventIds && count($eventIds)) {
            foreach ($eventIds as $id=>$value) {
                $event = Event::find($id);
                if ($event) {
                    $totalPrice += $value['quantity'] * $event->price;
                }
            }
        }

        $totalPrice = number_format($totalPrice, 2, ',', ' ');
        return view('pages.checkout', ['total' => $totalPrice]);
    }
}
