require('./bootstrap');

window.showLoginForm = function() {
    hideRegisterForm();
    document.getElementById('login-sidebar').style.width = '40%';
}

window.hideLoginForm = function () {
    document.getElementById('login-sidebar').style.width = "0";
}

window.showRegisterForm = function () {
    hideLoginForm();
    document.getElementById('register-sidebar').style.width = '40%';
}

window.hideRegisterForm = function () {
    document.getElementById('register-sidebar').style.width = "0";
}
