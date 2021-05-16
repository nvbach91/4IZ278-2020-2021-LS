<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <i class="fas fa-ticket-alt mr-1"></i>
        Sport Ticket
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('events') ? 'active' : '' }}" href="{{route('events')}}">Sport Events</a>
            </li>
        </ul>
        <ul class="navbar-nav mr-0">
            @if(auth()->check())
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('profile') ? 'active' : '' }}" href="{{route('profile')}}">
                        <i class="mr fas fa-user"></i>
                        {{auth()->user()->username}}</a>
                </li>
                <li class="nav-item pr-1">
                    <a class="nav-link {{ Route::is('cart') ? 'active' : '' }}" href="{{route('cart')}}">
                        <i class="mr fas fa-shopping-cart"></i>
                        Cart
                    </a>
                </li>
                <li class="nav-item logout pl-1">
                    <a class="nav-link" href="{{route('logout')}}">
                        <i class="fas fa-sign-out-alt"></i>
                        Log Out
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showLoginForm()">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showRegisterForm()">Sign Up</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
