@extends('layouts.master')

@section('content')
    <h1 class="text-center fw-bold mt-2 mb-3">Profile</h1>

    <div class="container profile mb-5">
        <div class="d-flex ms-5 h-100">
            <div class="nav flex-column nav-pills profile-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" data-bs-target="#profile" data-bs-toggle="pill" href="#profile" id="profile-tab">
                    <i class="fas fa-info-circle me-2"></i>Profile Info
                </a>
                <a class="nav-link" data-bs-target="#tickets" data-bs-toggle="pill" href="#tickets" id="tickets-tab">
                    <i class="fas fa-list me-2"></i>Active Tickets
                    <span class="badge rounded-pill bg-dark">{{count($activeTickets)}}</span>
                </a>
                <a class="nav-link" data-bs-target="#history" data-bs-toggle="pill" href="#history" id="history-tab">
                    <i class="fas fa-history me-2"></i>Shopping History
                </a>
                <a class="nav-link" data-bs-target="#sports" data-bs-toggle="pill" href="#sports" id="sports-tab">
                    <i class="far fa-futbol me-2"></i>Favorite Sports
                    <span class="badge rounded-pill bg-dark">{{$user->favoriteSports->count()}}</span>
                </a>
                <a class="nav-link" data-bs-target="#settings" data-bs-toggle="pill" href="#settings" id="settings-tab">
                    <i class="fas fa-user-cog me-2"></i>Settings
                </a>
            </div>

            <div class="tab-content ps-4 flex-grow-1 profile-content pt-2" id="v-pills-tabContent" role="tabpanel" aria-labelledby="profile-tab">
                <div id="profile" class="tab-pane fade show active" role="tabpanel">
                    <h3>Profile Info</h3>
                    <p><span class="me-2">User:</span> {{$user->username}}</p>
                    <p><span class="me-2">Name:</span> {{$user->first_name}} {{$user->last_name}}</p>
                    <p><span class="me-2">Email:</span> {{$user->email}}</p>
                </div>
                <div id="tickets" class="tab-pane fade" role="tabpanel" aria-labelledby="tickets-tab">
                    <h3>Tickets</h3>
                    <ol>
                        @foreach($activeTickets as $ticket)
                            <li class="nav-link">
                                <a href="{{route('show-ticket', $ticket->ticket_id)}}" class="mb-2">Ticket#{{$ticket->ticket_id}}: {{$ticket->event->event_name}}</a>
                            </li>
                        @endforeach
                    </ol>
                </div>
                <div id="history" class="tab-pane fade" role="tabpanel" aria-labelledby="history-tab">
                    <h3>Shopping History</h3>
                    <ol>
                        @foreach($historyTickets as $ticket)
                            <li class="nav-link">
                                <a href="{{route('show-ticket', $ticket->ticket_id)}}" class="mb-2">Ticket#{{$ticket->ticket_id}}: {{$ticket->event->event_name}}</a>
                            </li>
                        @endforeach
                    </ol>
                </div>
                <div id="sports" class="tab-pane fade" role="tabpanel" aria-labelledby="sports-tab">
                    <h3>{{ucfirst($user->username)}}'s favorite sports</h3>

                    @if(isset($message) && !empty($message))
                    <div class="alert alert-success">
                        <p>{{$message}}</p>
                    </div>
                    @endif

                    <ul class="list-group mb-4 col-md-6">
                        @foreach($user->favoriteSports as $favorite)
                            <li class="list-group-item list-group-item-action list-group-item-dark d-flex justify-content-between align-items-center">
                                {{ucfirst($favorite->sport_name)}}
                            </li>
                        @endforeach
                    </ul>
                    <a class="btn btn-outline-dark" href="{{route('sports')}}">Go to Sports</a>
                </div>
                <div id="settings" class="tab-pane fade" role="tabpanel" aria-labelledby="settings-tab">
                    <h3>Settings</h3>

                    @include('components.result-messages')

                    <div class="accordion me-4 w-75 mb-4" id="settings-accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-password">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#changePassword" aria-expanded="false" aria-controls="changePassword">
                                    Change password
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="changePassword">
                                <div class="accordion-body w-75">
                                    <form action="{{route('password')}}" method="POST">
                                        @csrf
                                        <label for="currentPassword">Enter current password</label>
                                        <input type="password" class="form-control" id="currentPassword" name="curr_pass">
                                        <label for="newPassword">Enter new password</label>
                                        <input type="password" class="form-control" id="newPassword" name="new_pass">
                                        <label for="confirmPassword">Confirm new password</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="new_pass_confirmation">
                                        <button type="submit" class="btn btn-danger mt-2 text-white">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-username">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#changeUsername" aria-expanded="false" aria-controls="changeUsername">
                                    Change username
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="changeUsername">
                                <div class="accordion-body w-75">
                                    <form action="{{route('username')}}" method="POST">
                                        @csrf
                                        <label for="currentPassword">Change your username</label>
                                        <input type="text" class="form-control" id="username" value="{{$user->username}}" name="username">
                                        <label for="currentPassword">Enter password</label>
                                        <input type="password" class="form-control" id="currentPassword" name="uname_pass">
                                        <button type="submit" class="btn btn-danger mt-2 text-white">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-email">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#changeEmail" aria-expanded="false" aria-controls="changeEmail">
                                    Change email address
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="changeEmail">
                                <div class="accordion-body w-75">
                                    <form action="{{route('email')}}" method="POST">
                                        @csrf
                                        <label for="email">Change email address</label>
                                        <input type="text" class="form-control" id="email" value="{{$user->email}}" name="email">
                                        <label for="currentPassword">Enter password</label>
                                        <input type="password" class="form-control" id="currentPassword" name="email_pass">
                                        <button type="submit" class="btn btn-danger mt-2 text-white">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
