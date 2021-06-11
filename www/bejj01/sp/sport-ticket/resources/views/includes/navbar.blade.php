<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand ms-3" href="#">
        <i class="fas fa-ticket-alt me-1"></i>
        Sport Ticket
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
            <li class="nav-item flex-center {{ Route::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('home')}}">Home</a>
                <div class="active-indicator"></div>
            </li>
            <li class="nav-item flex-center {{ Route::is('events') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('events')}}">Sport Events</a>
                <div class="active-indicator"></div>
            </li>
            <li class="nav-item flex-center {{ Route::is('sports') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('sports')}}">Sports</a>
                <div class="active-indicator"></div>
            </li>
        </ul>
        <ul class="navbar-nav me-0">
            @if(auth()->check())
                <li class="nav-item flex-center {{ Route::is('profile') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('profile')}}">
                        <i class="fas fa-user-circle"></i>
                        {{auth()->user()->username}}
                    </a>
                    <div class="active-indicator"></div>
                </li>
                <li class="nav-item flex-center pe-1 {{ Route::is('cart') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('cart')}}">
                        <i class="me fas fa-shopping-cart"></i>
                        Cart
                    </a>
                    <div class="active-indicator"></div>
                </li>
                <li class="nav-item flex-center logout ps-1">
                    <a class="nav-link" href="{{route('logout')}}" onclick="clearLocalStorage()">
                        <i class="fas fa-sign-out-alt"></i>
                        Log Out
                    </a>
                    <div class="active-indicator"></div>
                </li>
            @else
                <li class="nav-item flex-center {{ Route::is('login-form') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('login-form')}}">Sign In</a>
                    <div class="active-indicator"></div>
                </li>
                <li class="nav-item flex-center {{ Route::is('register-form') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('register-form')}}">Sign Up</a>
                    <div class="active-indicator"></div>
                </li>
            @endif
        </ul>
    </div>
</nav>
