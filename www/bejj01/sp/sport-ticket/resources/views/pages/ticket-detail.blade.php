@extends('layouts.master')

@section('content')
    <h1 class="text-center font-weight-bold mt-2 mb-3">Ticket Detail</h1>

    <div class="d-flex flex-column align-items-center flex-grow-1">
        <div class="ticket-container mb-3 d-flex flex-column align-items-center">
            <h3 class="w-100 text-center bg-info text-white">Ticket #{{$ticket->ticket_id}}</h3>
            <div class="d-flex justify-content-center flex-wrap w-100 mb-1 pr-3 pl-3">
                <span class="font-weight-bold">{{$ticket->event->event_name}}</span>
            </div>
            <!-- TODO display place only if column is filled -->
            <div class="d-flex justify-content-between flex-wrap w-100 mb-1 pr-3 pl-3">
                <span>Place:</span>
                <!-- TODO check for place country, display if available -->
                <span>{{$ticket->event->place->place_name}}, {{$ticket->event->place->city}}</span>
            </div>
            <div class="d-flex justify-content-between flex-wrap w-100 mb-1 pr-3 pl-3">
                <span>Date:</span>
                <span>{{$ticket->event->formatDate($ticket->event->start_date)}}</span>
            </div>
            <div class="d-flex justify-content-between flex-wrap w-100 mb-1 pr-3 pl-3">
                <span>Sport:</span>
                <span>{{$ticket->event->sport->sport_name}}</span>
            </div>
            @if($ticket->event->competition)
                <div class="d-flex justify-content-between flex-wrap w-100 mb-1 pr-3 pl-3">
                    <span>Competition:</span>
                    <span>{{$ticket->event->competition}}</span>
                </div>
            @endif

            @if($ticket->event->description)
                <p class=" pr-3 pl-3">{{$ticket->event->description}}</p>
            @endif
            <div class="d-flex justify-content-between align-items-center flex-wrap w-100 mt-2 pr-3 pl-3">
                <span class="font-weight-bold">{{$ticket->event->price}} CZK</span>
                <!-- TODO QRCODE -->
                <span>Here will be generated qr code</span>
            </div>
            <hr class="w-85 pr-3 pl-3">
            <!-- TODO PDF ticket output file -->
            <div>Maybe PDF file output</div>
        </div>
        <a class="mb-3 btn btn-outline-dark" href="{{route('profile')}}"><i class="fas fa-arrow-left mr-1"></i>Go Back</a>
    </div>
@endsection
