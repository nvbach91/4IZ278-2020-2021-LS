<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;

/**
 * Class TicketController - Handles actions related to tickets
 * @package App\Http\Controllers
 */
class TicketController extends Controller
{
    /**
     * Creates new ticket
     * @return \Illuminate\Http\RedirectResponse
     */
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

            //reduce capacity of tickets after buying them
            $event->capacity -= $item['quantity'];
            $event->save();
        }

        return redirect()->route('profile');
    }

    /**
     * Shows specific ticket
     * @param $id - id of ticket
     * @return mixed
     */
    public function showTicket($id) {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return redirect()->route('home')->with('error', 'Wrong action! Ticket was not found!');
        }

        return view('pages.ticket-detail', ['ticket' => $ticket]);
    }

    /**
     * Generates pdf output for ticket
     * @param $ticket_id - id of ticket
     * @return mixed
     */
    public function createPDF($ticket_id) {
        $ticket = Ticket::find($ticket_id);
        if (!$ticket) {
            return redirect()->route('home')->with('error', 'Wrong action! Ticket was not found!');
        }

        // share data to view
        view()->share('ticket', $ticket);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('components.ticket-print', $ticket);
        $pdfFileName = 'ticket' . $ticket_id . '.pdf';

        // download PDF file with download method
        return $pdf->download($pdfFileName);
    }
}
