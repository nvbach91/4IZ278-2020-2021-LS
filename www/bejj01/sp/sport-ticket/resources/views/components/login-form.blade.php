<div class="d-flex w-100 justify-content-center pe-2 ps-2">
    <div class="d-flex flex-column col-md-6 justify-content-start align-items-center border-r-1">
        <h3 class="text-decoration-underline">Simple login</h3>
        <form class="login-form d-flex flex-column w-50" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group pb-2">
                <label for="login-email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="login-email" placeholder="Enter your email" name="email" value="{{old('email')}}">
                @error('email')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="login-password" placeholder="Enter password" name="password">
                @error('password')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <a href="#">Forgot Password?</a>
            </div>
            <div class="d-flex flex-column align-items-center justify-content-center mt-3">
                <button type="submit" class="btn btn-success mt-2 text-white mb-2">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>
            </div>
        </form>
    </div>
    <div class="d-flex flex-column col-md-6 justify-content-start align-items-center">
        <h3 class="text-decoration-underline">Login with social media accounts</h3>
        <div class="d-flex flex-column">
            <a href="{{route('login.service', 'facebook')}}" class="btn btn-facebook mb-2 mt-4 text-white"><i class="fab fa-facebook me-2"></i>Login with Facebook</a>
            <p class="mb-2 text-center">- or -</p>
            <a href="{{route('login.service', 'google')}}" class="btn btn-google mb-2 text-white"><i class="fab fa-google me-2"></i>Login with Google</a>
        </div>
    </div>
</div>
