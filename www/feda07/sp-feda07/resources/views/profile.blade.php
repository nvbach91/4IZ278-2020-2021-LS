@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <img src="{{asset($user->avatar)}}" alt="avatar" class="img-thumbnail">
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
                    <h2>About me: {{$user->about_me}}</h2>
                </div>
                <div class="row">
                    <a href="{{route('profile.edit')}}">Edit</a>
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
                    <p>{{$reservation->date_from->format(\App\Constants\TimeConstants::$date)}}  {{$reservation->date_from->format(\App\Constants\TimeConstants::$time)}} - {{$reservation->service->name}}</p>
                    <a class="btn btn-danger" href="{{ route('profile.reservation.delete') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('reservation-delete-form-{{$reservation->id}}').submit();">
                        {{ __('Delete') }}
                    </a>

                    <form id="reservation-delete-form-{{$reservation->id}}" action="{{ route('profile.reservation.delete') }}" method="POST" class="d-none">
                        <input name="reservationId" type="hidden" value="{{$reservation->id}}">
                        @csrf
                    </form>
                @empty
                    <p>{{__('No reservations yet')}}</p>

                @endforelse
            </div>
        </div>
    </div>
@endsection
