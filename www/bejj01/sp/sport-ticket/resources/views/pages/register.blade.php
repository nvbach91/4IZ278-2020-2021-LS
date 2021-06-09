@extends('layouts.master')

@section('content')
    <h1 class="text-center fw-bold mt-2 mb-3">Sign Up</h1>

    <div class="d-flex flex-column align-items-center flex-grow-1 mb-3">
        <div class="d-flex mb-4 align-items-center">
            <p class="mb-0 mt-0 me-2">Already have an account?</p>
            <a href="{{route('login-form')}}" class="btn btn-outline-primary">Go to login</a>
        </div>

        <div class="d-flex w-100">
            <div class="col-md-6 d-flex flex-column align-items-center border-r-1">
                <h3 class="mb-3 text-decoration-underline">Sign Up form</h3>
                @include('components.register-form')
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center">
                <h3 class="text-decoration-underline">Get in with social media accounts</h3>
                <div class="d-flex flex-column">
                    <a href="{{route('login.service', 'facebook')}}" class="btn btn-facebook mb-2 mt-4 text-white"><i class="fab fa-facebook me-2"></i>Use Facebook account</a>
                    <p class="mb-2 text-center">- or -</p>
                    <a href="{{route('login.service', 'google')}}" class="btn btn-google mb-2 text-white"><i class="fab fa-google me-2"></i>Use Google account</a>
                </div>
            </div>
        </div>
    </div>
@endsection
