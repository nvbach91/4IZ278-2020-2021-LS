@extends('layouts.print')

@section('content')
    <h1>Ticket Detail</h1>

    <div>
        <h3>{{$ticket->event->event_name}}</h3>
        <hr>
        @if($ticket->event->place)
            <p>
                <span>Place:</span>
                <span>{{$ticket->event->place->place_name}}, {{$ticket->event->place->city}} @if($ticket->event->place->country), {{$ticket->event->place->country}} @endif</span>
            </p>
        @endif
        <p>
            <span>Date:</span>
            <span>{{$ticket->event->formatDate($ticket->event->start_date)}} @if($ticket->event->end_date){{$ticket->event->formatDate($ticket->event->end_date)}}@endif</span>
        </p>
        <p>
            <span>Sport:</span>
            <span>{{$ticket->event->sport->sport_name}}</span>
        </div>
        @if($ticket->event->competition)
            <p>
                <span>Competition:</span>
                <span>{{$ticket->event->competition}}</span>
            </p>
        @endif

        @if($ticket->event->description)
            <p>{{$ticket->event->description}}</p>
        @endif

        <p>
            <span>Price:</span>
            <span style="font-weight: bold;">{{$ticket->event->formatPrice($ticket->event->price)}} CZK</span>
        </p>
        <div>
            <!-- Generated QR code form ticket id and event name -> unique combination-->
            <img src="data:image/png;base64, {{ base64_encode(QrCode::size(200)->generate('Make me into an QrCode!')) }} ">
        </div>
    </div>

    <p style="position:fixed; bottom: 50px;">© 2021 Copyright: SportTicket</p>
@endsection
