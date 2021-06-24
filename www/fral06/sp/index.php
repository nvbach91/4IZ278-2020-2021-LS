<?php
//Head
include "components/head.php";
//Navigation
include "components/nav.php";

session_start();

$msg ='';
if(isset($_GET['registration'])){
    $msg = 'Thanks for your registration. You can login now!';
}

if ((isset($_SESSION['user_email']))) {
    header('Location: main.php');
}
?>
<div class="container text-center">
    <div class="d-flex flex-column justify-content-center vh-75 ">
        <?php if ($msg != '') : ?>
            <div class="alert alert-success mx-auto w-50"><?php echo $msg; ?></div>
        <?php endif; ?>
        <h1>Welcome!</h1>
        <p>Please login or create a new account.</p>
        <div>
            <a href="login.php" class="btn btn-outline-primary">Login</a>
            <a href="registration.php" class="btn btn-outline-dark">Create an account</a>
        </div>
    </div>

</div>
