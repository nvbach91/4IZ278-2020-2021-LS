<div id="register-sidebar" class="registration sidebar bg-dark text-white">
    <a class="cancel-button" href="javascript:void(0)" onclick="hideRegisterForm()"><i class="far fa-times-circle"></i></a>
    <div class="sidebar-container">
        <h2>Sign Up</h2>
        <div class="d-flex align-items-center mb-3 pb-2 justify-content-center">
            <p class="mb-0">Already have an account?</p>
            <a class="pl-2 ml-3 btn btn-outline-info" href="#" onclick="showLoginForm()">Sign In</a>
        </div>
        @include('components.register')
    </div>
</div>
