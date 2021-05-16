<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sport;
use App\Models\Ticket;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Config;

class EventController extends Controller {
    public function index() {
        $events = Event::all();
        return view('pages.events-offer', ['events' => $events]);
    }

    public function addToCart($id) {
        $event = Event::find($id);
        if(!$event) {
            //todo not found event
        }

        $cart = session()->get('cart');

        if (!$cart) {
            $data = [
                $id => ['quantity' => 1]
            ];
            session()->put('cart', $data);
        }

        // increase event quantity case
        else if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }
        // if item not exist in cart then add to cart with quantity = 1
        else {
            $cart[$id] = [
                "quantity" => 1,
            ];
            session()->put('cart', $cart);
        }

        return redirect('/cart');
    }

    public function removeFromCart($id) {
        $event = Event::find($id);
        if(!$event) {
            //todo not found event
        }

        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect('/cart');
    }

    public function cart() {
        $eventIds = session()->get('cart');
        $events = [];
        $totalPrice = 0;

        if ($eventIds && count($eventIds)) {
            foreach ($eventIds as $id=>$value) {
                $event = Event::find($id);
                if ($event) {
                    $event->quantity = $value['quantity'];
                    $totalPrice += $value['quantity'] * $event->price;
                    array_push($events, $event);
                }
            }
        }

        return view('pages.cart', ['events' => $events, 'total' => $totalPrice]);
    }
}
