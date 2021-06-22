<?php
require_once __DIR__ . '/models/UserDB.php';

$userManager = new UserDB();

$invalidInputs = [];
$msg = '';


if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = htmlspecialchars(trim(($_POST['email'])));
    $password = htmlspecialchars(trim(($_POST['password'])));
    $firstName = htmlspecialchars(trim(($_POST['firstName'])));
    $lastName = htmlspecialchars(trim(($_POST['lastName'])));

    if (!$email) {
        array_push($invalidInputs, 'Email is empty');
        $msg = 'Email is empty';
    }

    if (!$password) {
        array_push($invalidInputs, 'Password is empty');
        $msg = 'Password is empty';
    }

    if (!$firstName) {
        array_push($invalidInputs, 'First Name is empty');
        $msg = 'First name is empty';
    }

    if (!$lastName) {
        array_push($invalidInputs, 'Last name is empty');
        $msg = 'Last name is empty';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Email has invalid format');
        $msg = 'Email has invalid format';
    }

    if (empty($invalidInputs)) {

        $userRecord =  $userManager->fetchUserByEmail($email);
        if ($userRecord) {
            $msg = 'User already exists';
        }
        else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $userManager->insert($email, $hashedPassword, 1, $firstName, $lastName);

            header('Location: index.php');
        }
    }
}

?>

<?php
//Head
include "components/head.php";
//Navigation
include "components/nav.php"
?>



<div class="container">
    <main class="form-signin text-center">
        <form method="POST">
            <h1 class="h3 mb-3 fw-normal">Registration page</h1>
            <?php if ($msg != '') : ?>
                <div class="alert alert-danger"><?php echo $msg; ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <input type="text" aria-label="Name" class="form-control"  name="firstName" id="name" placeholder="Name">
            </div>
            <div class="mb-3">
                <input type="text" aria-label="Last Name" class="form-control" name="lastName" id="lastName" placeholder="Last Name">
            </div>
            <div class="mb-3">
                <input type="email" aria-label="Email address" class="form-control" name="email" id="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <input type="password" aria-label="Password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="mb-3">
                <input type="password" aria-label="Password again" class="form-control" name="passwordAgain" id="passwordAgain" placeholder="Password Again">
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
            <p class="mt-5 mb-3 text-muted">© 2021</p>
        </form>
    </main>
</div>

<?php
include "components/foot.php";
?>

