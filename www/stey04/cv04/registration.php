<?php
require "utils.php";

$isSubmitted = !empty($_POST);

if ($isSubmitted) {
    $name = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $password2 = htmlspecialchars(trim($_POST['password2']));

    if (!$name) {
        array_push($invalidInputs, 'Username is empty');
    }

    if (!$email) {
        array_push($invalidInputs, 'Email is empty');
    }
    if (!$password) {
        array_push($invalidInputs, 'Password is empty');
    }

    if (!preg_match('/^[a-zA-Z0-9]{4,}$/', $password)) {
        array_push($invalidInputs, 'Password is too short');
    }

    if ($password !== $password2) {
        array_push($invalidInputs, 'Passwords are not matching');
    }

    if (empty($invalidInputs)) {
        $regRes = makeRegistration($_POST);
        if (empty($regRes)) {
            array_push($invalidInputs, 'User already exists!🧐');
        } else {
            header("Location: login.php?email=$email");
        }
    }
    makeAlerts();
}
?>

<?php include __DIR__ . '/includes/header.php' ?>
<main>
    <h1>Sign Up</h1>
    <?php if ($isSubmitted) : ?>
        <div class="alert <?php echo $alert ?>" role="alert">
            <?php echo $alertMessages ?>
        </div>
    <?php endif; ?>
    <form class="form-signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="mb-3">
            <label for="user" class="form-label">Username</label>
            <input name="username" type="" class="form-control" id="user">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input name="email" type="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll share your email with everyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            <div class="form-text">4 characters long</div>
        </div>
        <div class="mb-3">
            <label>Confirm Password</label>
            <input name="password2" type="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>
<?php include __DIR__ . '/includes/footer.php' ?>