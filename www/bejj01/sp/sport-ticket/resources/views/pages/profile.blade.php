@extends('layouts.master')

@section('content')
    <h1 class="text-center font-weight-bold mt-2 mb-3">Profile</h1>

    <div class="container">
        <hr>
        <div class="d-flex ml-5">
            <div class="nav flex-column nav-pills profile-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" data-target="#profile" data-toggle="pill" href="#profile" id="profile-tab">Profile Info</a>
                <a class="nav-link" data-target="#tickets" data-toggle="pill" href="#tickets" id="tickets-tab">Active Tickets</a>
                <a class="nav-link" data-target="#history" data-toggle="pill" href="#history" id="history-tab">Shopping History</a>
                <a class="nav-link" data-target="#settings" data-toggle="pill" href="#settings" id="settings-tab">Settings</a>
            </div>

            <div class="tab-content pl-4 flex-grow-1 profile-content" id="v-pills-tabContent">
                <div id="profile" class="tab-pane fade show active" role="tabpanel">
                    <h3>Profile Info</h3>
                    <p><span class="mr-2">User:</span> {{$user->username}}</p>
                    <p><span class="mr-2">Name:</span> {{$user->first_name}} {{$user->last_name}}</p>
                    <p><span class="mr-2">Email:</span> {{$user->email}}</p>
                </div>
                <div id="tickets" class="tab-pane fade" role="tabpanel">
                    <h3>Tickets</h3>
                    <ol>
                        @foreach($user->tickets as $ticket)
                            <li class="nav-link">
                                <a href="{{route('show-ticket', $ticket->ticket_id)}}" class="row mb-2">{{$ticket->event->event_name}}</a>
                            </li>
                        @endforeach
                    </ol>
                </div>
                <div id="history" class="tab-pane fade" role="tabpanel">
                    <h3>Shopping History</h3>
                    <p>Some history</p>
                </div>
                <div id="settings" class="tab-pane fade" role="tabpanel">
                    <h3>Settings</h3>
                    <div class="mb-2">
                        <a href="" class="btn btn-danger">Change password</a>
                    </div>
                    <div class="mb-2">
                        <a href="" class="btn btn-danger">Change username</a>
                    </div>
                    <div class="mb-2">
                        <a href="" class="btn btn-danger">Change email address</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
