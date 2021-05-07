@if(!Illuminate\Support\Facades\Auth::check())
    <a href="{{ route("login") }}">Login</a>
@else
    <div class="row">
        <div class="col">
            <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->getEmail()) }}?s=128&d=mm&r=g" class="rounded-full" style="width: 32px" alt="profile">
        </div>
        <div class="col-auto d-flex align-items-center pl-0">
            <span>{{ auth()->user()->name }}</span>
            <span class="ml-3"><a href="/logout">Logout</a></span>
        </div>
    </div>
@endif
