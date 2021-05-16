<div id="login-sidebar" class="login sidebar bg-dark text-white">
    <a class="cancel-button" href="javascript:void(0)" onclick="hideLoginForm()"><i class="far fa-times-circle"></i></a>
    <div class="sidebar-container">
        <h2>Sign In</h2>
        <div class="d-flex align-items-center mb-3 pb-2 justify-content-center">
            <p class="mb-0">Don't have an account?</p>
            <a href="#" class="pl-2 ml-3 btn btn-outline-info" onclick="showRegisterForm()">Sign Up</a>
        </div>
        @include('components.login')
    </div>
</div>
