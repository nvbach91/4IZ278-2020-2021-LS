@extends('layouts.master')

@section('content')
    <div class="content flex-grow-1">
        <header class="page-header gradient text-white">
            <div class="container-lg intro-section">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col-md-6">
                        <h1 class="text-center fw-bold pt-2 pb-3">
                            <i class="fas fa-ticket-alt me-1"></i>
                            Sport Ticket
                        </h1>
                        <p>Sport Ticket is an online website where you can purchase tickets to various sport events.
                            We offer tickets to sports like football, basketball, motorsport, etc.</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-outline-light me-3" href="{{route('events')}}">See tickets offer</a>
                            <a class="btn btn-outline-light" href="{{route('sports')}}">See sports</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex image-container">
                            <img class="ticket-img lazyload" data-src="{{asset('img/ticket.png')}}" alt="ticket image">
                        </div>
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f8f9fa" fill-opacity="1" d="M0,96L40,90.7C80,85,160,75,240,69.3C320,64,400,64,480,85.3C560,107,640,149,720,149.3C800,149,880,107,960,96C1040,85,1120,107,1200,106.7C1280,107,1360,85,1400,74.7L1440,64L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
            @if(auth()->check())
                <div class="d-flex flex-column bg-light text-dark justify-content-center align-items-center">
                    <p class="display-6 mb-4">You are logged in as: </p>
                    <div class="d-flex justify-content-center align-items-stretch mb-4">
                        <div class="d-flex align-items-center display-6 fw-bold pe-3 me-3 border-r-2">{{auth()->user()->username}}</div>
                        <div>
                            <p class="mb-0 pb-1">Bought tickets: {{count(auth()->user()->tickets)}}</p>
                            <p class="mb-0 pt-1">Favorite sports: {{count(auth()->user()->favoriteSports)}}</p>
                        </div>
                    </div>
                    <a class="btn btn-outline-dark" href="{{route('profile')}}"><i class="fas fa-user-circle me-2"></i>Go to profile</a>
                </div>
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f8f9fa" fill-opacity="1" d="M0,128L48,117.3C96,107,192,85,288,112C384,139,480,213,576,208C672,203,768,117,864,112C960,107,1056,181,1152,208C1248,235,1344,213,1392,202.7L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
            <div class="container intro-section">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex image-container">
                            <img class="ticket-img lazyload" data-src="{{asset('img/cart-icon.png')}}" alt="ticket image">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h1 class="text-center fw-bold pt-2 pb-3">
                            <i class="fas fa-icon-buffer me-1"></i>
                            Database storage
                        </h1>
                        <p class="text-center">We currently store:</p>
                        <div>
                            <ul class="fw-bold d-flex flex-column align-items-center">
                                <li>{{$homeInfo['eventCount']}} events</li>
                                <li>{{$homeInfo['sportCount']}} sports</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f8f9fa" fill-opacity="1" d="M0,96L40,90.7C80,85,160,75,240,69.3C320,64,400,64,480,85.3C560,107,640,149,720,149.3C800,149,880,107,960,96C1040,85,1120,107,1200,106.7C1280,107,1360,85,1400,74.7L1440,64L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
        </header>
    </div>
@endsection
