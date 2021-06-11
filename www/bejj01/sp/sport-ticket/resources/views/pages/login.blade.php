@extends('layouts.master')

@section('content')
    <h1 class="text-center fw-bold mt-2 mb-3">Sign In</h1>

    @if($errors->has('msg'))
        <div class="d-flex justify-content-center">
            <div class="d-flex w-75 justify-content-center alert alert-danger text-center mb-3">
                {{$errors->first()}}
            </div>
        </div>
    @endif

    <div class="d-flex flex-column align-items-center flex-grow-1 mb-3">
        <div class="d-flex mb-4 align-items-center">
            <p class="mb-0 mt-0 me-2">Don't have an account?</p>
            <a href="{{route('register-form')}}" class="btn btn-outline-primary">Register here</a>
        </div>
        @include('components.login-form')
    </div>
@endsection
