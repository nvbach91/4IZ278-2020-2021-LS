<?php

namespace App\Mail;

use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationComplited extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param Reservation $reservation
     */
    public function __construct(private Reservation $reservation)
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.reservation-mail', [
            'reservation' => $this->reservation
        ]);
    }
}
