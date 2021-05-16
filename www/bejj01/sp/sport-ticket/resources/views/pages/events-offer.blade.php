@extends('layouts.master')

@section('content')
    @include('components.register-sidebar')
    @include('components.login-sidebar')

    <div class="container">
        <h1 class="text-center font-weight-bold mt-2 mb-3">Events Offer</h1>

        <ul class="nav nav-tabs justify-content-center" id="sportsTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Football</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Basketball</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

        </div>

        <div class="d-flex flex-wrap justify-content-around mb-3 mt-2">
            @foreach($events as $event)
                @include('components.event')
            @endforeach
        </div>

        <nav aria-label="Page navigation example" class="d-flex mb-3 justify-content-center">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
@endsection
