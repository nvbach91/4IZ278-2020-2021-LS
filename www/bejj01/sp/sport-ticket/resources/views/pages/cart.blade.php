@extends('layouts.master')

@section('content')
    <h1 class="text-center font-weight-bold mt-2 mb-3">Shopping Cart</h1>

    <div class="container mt-2">
        @if(count($events) == 0)
            <h3 class="text-center">No tickets selected yet</h3>
            <hr>
            <div class="row justify-content-center align-items-center mb-3">
                <a class="btn btn-outline-dark mr-2" href="{{route('events')}}">Go Shopping</a>
                <a class="btn btn-outline-dark mr-2" href="{{route('home')}}">Go Home</a>
                <a class="btn btn-outline-dark" href="{{route('profile')}}">See Profile</a>
            </div>
        @else
            <h3 class="text-center">Selected tickets</h3>
            <hr>

            @foreach($events as $event)
                <div class="row cart-item justify-content-around align-items-center">
                    @include('components.cart-event')
                    <div class="spinner row">
                        <div class="down bg-dark text-white" onclick="this.nextElementSibling.stepDown(1)"><i class="fas fa-minus"></i></div>
                        <input class="spinner-number" type="number" min="1" max="10" value="{{$event->quantity}}">
                        <div class="up bg-dark text-white" onclick="this.previousElementSibling.stepUp(1)"><i class="fas fa-plus"></i></div>
                    </div>
                    <div><a href="{{route('remove', $event->event_id)}}"><i class="display-4 text-danger far fa-times-circle"></i></a></div>
                </div>
            @endforeach

            <p class="text-center display-4 font-weight-bold">Total price: {{$event->formatPrice($total)}} CZK</p>

            <div class="row justify-content-center align-items-center mb-3">
                <a class="btn btn-outline-dark mr-2" href="{{route('events')}}">Go Back Shopping</a>
                <a class="btn btn-outline-dark" href="{{route('checkout', $total)}}">Go To Checkout</a>
            </div>
        @endif
    </div>
@endsection
