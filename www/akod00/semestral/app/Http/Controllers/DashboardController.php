<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventParticipant;
use Illuminate;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware(Authenticate::class);
//    }

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route("dashboard");
        }

        return response()->view("index");
    }

    public function dashboard(): Response
    {
        $myEvents =
            Event::where("owner_id", $this->getUser()->getId())
                ->get();
        $participatedEvents =
            EventParticipant::where("participant_id", $this->getUser()->getId())
                ->leftJoin("events", "event_participants.event_id", "events.id")
                ->where("events.owner_id", "!=", $this->getUser()->getId())
                ->get();

        return response()->view('dashboard.index', [
            "myEvents" => $myEvents,
            "participatedEvents" => $participatedEvents
        ]);
    }

}
