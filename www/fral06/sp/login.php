<?php
session_start();
require_once __DIR__ . '/models/UserDB.php';

$invalidInputs = [];
$msg = '';

if ('POST' == $_SERVER['REQUEST_METHOD']) {

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $userManager = new UserDB();
    $user = $userManager->fetchUserByEmail($email);

    if (@password_verify($password, $user['passwordHash'])) {
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['firstName'] = $user['firstName'];
        $_SESSION['lastName'] = $user['lastName'];

            var_dump($_SESSION);
        header('Location: main.php');
    } else {
        $msg = 'Combination of email and password is incorrect';
    }
}
//Head
include "components/head.php";
//Navigation
include "components/nav.php"
?>

<div class="container d-flex align-items-center justify-content-center">
    <main class="form-signin text-center">
        <form method="POST">
            <h1 class="h3 mb-3 fw-normal">Please sign</h1>
            <?php if ($msg != '') : ?>
                <div class="alert alert-danger"><?php echo $msg; ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <input type="email" aria-label="Email address" class="form-control" name="email" id="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <input type="password" aria-label="Password" class="form-control" name="password" id="password" placeholder="Password">
            </div>

            <button class="w-100 btn btn-lg btn-primary mb2" type="submit">Sign in</button>
            <a href="registration.php" class="btn btn-link">Create an account.</a>
            <p class="mt-5 mb-3 text-muted">© 2021</p>
        </form>
    </main>
</div>

<?php
include "components/foot.php";
?>
