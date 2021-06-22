<?php


$invalidInputs = [];
$msg = '';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $usersDB = new UsersDB();
    $user = $usersDB->fetchUserByEmail($email);


    if (@password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['role'] = $user['role'];


        header('Location: main.php');
    } else {
        $msg = 'Combination of email and password is incorrect';
        $msgClass = 'alert-danger';
    }
}
//Head
include "components/head.php";
//Navigation
include "components/nav.php"
?>

<div class="container d-flex align-items-center justify-content-center">
    <main class="form-signin text-center">
        <form action="POST">
            <h1 class="h3 mb-3 fw-normal">Please sign</h1>
            <div>
                <input type="email" aria-label="Email address" class="form-control" name="email" id="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <input type="password" aria-label="Password" class="form-control" name="password" id="password" placeholder="Password">
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">© 2021</p>
        </form>
    </main>
</div>

<?php
include "components/foot.php";
?>
