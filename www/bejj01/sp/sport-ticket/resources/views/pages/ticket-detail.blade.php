@extends('layouts.master')

@section('content')
    <h1 class="text-center fw-bold mt-2 mb-3">Ticket Detail</h1>

    <div class="d-flex flex-column align-items-center flex-grow-1">
        <div class="ticket-container mb-3 d-flex flex-column align-items-center">
            <h3 class="w-100 text-center bg-info text-white">Ticket #{{$ticket->ticket_id}}</h3>
            <div class="d-flex justify-content-center flex-wrap w-100 mb-1 pe-3 ps-3">
                <span class="fw-bold">{{$ticket->event->event_name}}</span>
            </div>
            @if($ticket->event->place)
            <div class="d-flex justify-content-between flex-wrap w-100 mb-1 pe-3 ps-3">
                <span>Place:</span>
                <span>{{$ticket->event->place->place_name}}, {{$ticket->event->place->city}}@if($ticket->event->place->country), {{$ticket->event->place->country}} @endif</span>
            </div>
            @endif
            <div class="d-flex justify-content-between flex-wrap w-100 mb-1 pe-3 ps-3">
                <span>Date:</span>
                <span>
                    {{$ticket->event->formatDate($ticket->event->start_date)}}
                    @if($ticket->event->end_date)
                        {{$ticket->event->formatDate($ticket->event->end_date)}}
                    @endif
                </span>
            </div>
            <div class="d-flex justify-content-between flex-wrap w-100 mb-1 pe-3 ps-3">
                <span>Sport:</span>
                <span>{{$ticket->event->sport->sport_name}}</span>
            </div>
            @if($ticket->event->competition)
                <div class="d-flex justify-content-between flex-wrap w-100 mb-1 pe-3 ps-3">
                    <span>Competition:</span>
                    <span>{{$ticket->event->competition}}</span>
                </div>
            @endif

            @if($ticket->event->description)
                <p class="text-muted pe-3 ps-3 text-justify mt-2">{{$ticket->event->description}}</p>
            @endif
            <div class="d-flex justify-content-between align-items-center flex-wrap w-100 mt-2 pe-3 ps-3">
                <div>
                    <p class="mb-1">Price:</p>
                    <div class="fw-bold">{{$ticket->event->price}} CZK</div>
                </div>
                <div class="visible-print text-center">
                    <!-- Generated QR code form ticket id and event name -> unique combination-->
                    {{ QrCode::size(100)->generate($ticket->ticket_id . $ticket->event->event_name) }}
                </div>
            </div>
            <hr class="w-85 pe-3 ps-3">
            <!-- TODO adjust the look of the pdf file -->
            <a class="mb-3" href="{{route('ticket-pdf', $ticket->ticket_id)}}">Download PDF output</a>
        </div>
        <a class="mb-3 btn btn-outline-dark" href="{{route('profile')}}"><i class="fas fa-arrow-left me-1"></i>Go Back</a>
    </div>
@endsection
