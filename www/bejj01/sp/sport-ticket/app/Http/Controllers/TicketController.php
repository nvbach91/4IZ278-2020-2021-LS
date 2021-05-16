<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create() {
        $cart = session()->get('cart');
        session()->remove('cart');
        $user = User::find(auth()->id(), 'user_id');

        foreach ($cart as $key=>$item) {
            $event = Event::find($key);
            $newData = [
                'event_id' => $event->event_id,
                'user_id' => $user->user_id,
            ];

            // create table rows for each ticket quantity (same data/ticket purchased more times)
            for ($i = 0; $i < $item['quantity']; $i++) {
                Ticket::create($newData);
            }
        }

        return redirect('/profile');
    }

    public function showTicket($id) {
        $ticket = Ticket::find($id);
        return view('pages.ticket-detail', ['ticket' => $ticket]);
    }
}
