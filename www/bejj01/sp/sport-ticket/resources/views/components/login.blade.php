<form class="login-form" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="login-email">Email</label>
        <input type="email" class="form-control" id="login-email" placeholder="Enter your email" name="email">
    </div>
    <div class="form-group">
        <label for="login-password">Password</label>
        <input type="password" class="form-control" id="login-password" placeholder="Enter password" name="password">
    </div>
    <div class="row justify-content-center">
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </div>
</form>
