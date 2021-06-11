<div class="d-flex w-100 justify-content-center">
    <form class="register-form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row mb-2">
            <div class="col-md-6">
                <label for="reg-f-name">First Name</label>
                <input class="form-control @error('reg_first_name') is-invalid @enderror" value="{{old('reg_first_name')}}" id="reg-f-name" placeholder="Enter First Name" name="reg_first_name">
                @error('reg_first_name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="reg-l-name">Last Name</label>
                <input class="form-control @error('reg_last_name') is-invalid @enderror" value="{{old('reg_last_name')}}" id="reg-l-name" placeholder="Enter Last Name" name="reg_last_name">
                @error('reg_last_name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-12 mb-2">
            <label for="reg-username">Username</label>
            <input type="text" class="form-control @error('reg_username') is-invalid @enderror" value="{{old('reg_username')}}" id="reg-username" placeholder="Enter Username" name="reg_username">
            @error('reg_username')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-md-12 mb-2">
            <label for="reg-email">Email</label>
            <input type="email" class="form-control @error('reg_email') is-invalid @enderror" value="{{old('reg_email')}}" id="reg-email" placeholder="Enter Email" name="reg_email">
            @error('reg_email')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-md-12 mb-2">
            <label for="reg-password">Password</label>
            <input type="password" class="form-control @error('reg_password') is-invalid @enderror" id="reg-password" placeholder="Enter Password" name="reg_password">
            @error('reg_password')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-md-12 mb-2">
            <label for="reg-confirm">Confirm Password</label>
            <input type="password" class="form-control" id="reg-confirm" placeholder="Enter Password Confirmation" name="reg_password_confirmation">
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-success mt-2">
                <i class="fas fa-user-plus me-2"></i>Create Account</button>
        </div>
    </form>
</div>
