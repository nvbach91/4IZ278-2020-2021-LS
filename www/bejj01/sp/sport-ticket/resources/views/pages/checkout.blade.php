@extends('layouts.master')

@section('content')
    <h1 class="text-center font-weight-bold mt-2 mb-3">Checkout</h1>

    <div class="container mt-2">
        <p class="text-center display-4 font-weight-bold">Total price: {{$total}} CZK</p>
    </div>
    <a href="{{route('purchase')}}" class="btn btn-primary">Checkout</a>
@endsection
