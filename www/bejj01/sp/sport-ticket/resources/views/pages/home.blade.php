@extends('layouts.master')

@section('content')
    @include('components.register-sidebar')
    @include('components.login-sidebar')

    <div class="content">
        <header class="page-header gradient text-white">
            <div class="container intro-section">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-6">
                        <h1 class="text-center font-weight-bold pt-2 pb-3">
                            <i class="fas fa-ticket-alt mr-1"></i>
                            Sport Ticket
                        </h1>
                        <p>Sport Ticket is a online website where you can purchase tickets to various sport events.
                            We offer tickets to sports like football, basketball, motorsport, etc.</p>
                        <div class="row justify-content-center">
                            <a class="btn btn-outline-light" href="events">See tickets offer</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex image-container">
                            <img class="ticket-img" src="{{asset('img/ticket.png')}}" alt="ticket image">
                        </div>
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f8f9fa" fill-opacity="1" d="M0,96L40,90.7C80,85,160,75,240,69.3C320,64,400,64,480,85.3C560,107,640,149,720,149.3C800,149,880,107,960,96C1040,85,1120,107,1200,106.7C1280,107,1360,85,1400,74.7L1440,64L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
        </header>
    </div>
@endsection
