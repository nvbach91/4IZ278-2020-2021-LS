@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <img src="{{$user->avatar}}" alt="avatar" class="img-thumbnail">
            </div>
            <div class="col">
                <div class="row">
                    <h2>Name: {{$user->name}}</h2>
                </div>
                <div class="row">
                    <h2>Surname: {{$user->surname}}</h2>
                </div>
                <div class="row">
                    <h2>Phone number: {{$user->phone}}</h2>
                </div>
                <div class="row">
                    <h2>Email: {{$user->email}}</h2>
                </div>
                <div class="row">
                    <h2>About me: </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h1>My reservations</h1>

            </div>
            <div class="col">
                <a href="{{route('service.index')}}">My services</a>
            </div>
        </div>
        <div class="row">
            <div class="container-reservation">
                @forelse($reservations as $reservation)
                    <p>{{$reservation->date_from->format(\App\Constants\TimeConstants::$time)}}</p>
                @empty
                    <p>{{__('No reservations yet')}}</p>

                @endforelse
            </div>
        </div>
    </div>
@endsection
