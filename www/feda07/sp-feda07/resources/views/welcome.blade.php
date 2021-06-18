@extends('layouts.app')

@section('content')
    @guest
    <div class="container welcome-container">
        <div class="row row-welcome">
            <div class="card-welcome">
                <h1 class="text-uppercase">{{__('Welcome to Reservacheck')}}</h1>
            </div>
        </div>
        <div class="row row-welcome">
            <h2>{{__('Do you have a profile?')}}</h2>
        </div>
        <div class="row row-welcome">
            <div class="col">
                <div class="row row-welcome">
                    <h3>{{__('Yes')}}</h3>
                </div>
                <div class="row row-welcome">
                    <a class="btn btn-outline-success" href="{{ route('login') }}">{{ __('Login') }}</a>
                </div>
            </div>
            <div class="col">
                <div class="row row-welcome">
                    <h3>{{__('No')}}</h3>
                </div>
                <div class="row row-welcome">
                    <a class="btn btn-outline-danger" href="{{ route('register') }}">{{ __('Register') }}</a>
                </div>
            </div>
        </div>
    </div>
    @endguest
@endsection
