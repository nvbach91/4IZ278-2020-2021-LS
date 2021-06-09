@extends('layouts.master')

@section('content')
    <h1 class="text-center fw-bold mt-2 mb-3">Checkout</h1>

    <div class="container mt-2">
        <p class="text-center display-4 fw-bold">Total price: {{$total}} CZK</p>

        <div class="d-flex justify-content-center align-items-center">
            <a href="{{route('cart')}}" class="btn btn-outline-dark me-2">
                <i class="fas fa-arrow-left me-1"></i>
                Back to Cart
            </a>
            <form action="{{route('purchase')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-wallet me-1"></i>
                    Checkout
                </button>
            </form>
        </div>
    </div>

@endsection
