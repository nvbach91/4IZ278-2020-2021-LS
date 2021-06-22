<?php
//Head
include "components/head.php";
//Navigation
include "components/nav.php";

session_start();

if ((($_SESSION['user_email']))) {
    header('Location: main.php');
}
?>
<div class="container text-center">
    <div class="d-flex flex-column justify-content-center vh-75 ">
        <h1>Welcome!</h1>
        <p>Please login in or create a new account.</p>
        <div>
            <a href="login.php" class="btn btn-outline-primary">Login</a>
            <a href="registration.php" class="btn btn-outline-dark">Create an account</a>
        </div>
    </div>

</div>
