<?php require __DIR__ . '/db/usersDB.php'; ?>
<?php
if(!isset($_SESSION)){
    session_start();
}
$usersDB = NEW UsersDB();
$invalidInputs = [];

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirmPassword']));

    if (!$name || !preg_match('/^[a-zA-Z ]*$/', $name)) {
        array_push($invalidInputs, 'Please enter valid name');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Please enter valid email');
    }

    if (!$password || strlen($password) < 8) {
        array_push($invalidInputs, 'Please enter valid password');
    }

    if ($password !== $confirmPassword) {
        array_push($invalidInputs, 'Passwords do not match');
    }

    if (empty($invalidInputs)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $usersDB->createUser($name, $email, $hashedPassword);
        $user_id = (int) $usersDB->findUserId($email);
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        header("Location: login.php?ref=registration&email=$email");
    }
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>
<main class="container-sm">
    <div class=" mb-2 text-center">
        <h2>Registration</h2>
    </div>
    <?php foreach ($invalidInputs as $invalidInput) : ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>
                <?php echo $invalidInput; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <form class="row g-3 form-registration" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="col-md-12">
            <label for="inputNameRegister" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="inputNameRegister" value ="<?php echo isset($name) ? $name : '' ?>" placeholder="John Smith" required>
        </div>
        <div class="col-md-12">
            <label for="inputEmailRegister" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="inputEmailRegister" value ="<?php echo isset($email) ? $email : '' ?>" placeholder="email@example.com" required>
        </div>
        <div class="col-md-12">
            <label for="inputPasswordRegister" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="inputPasswordRegister" required>
            <span class="text-muted">Minimum length is 8 characters</span>
        </div>
        <div class="col-md-12">
            <label for="inputPasswordRegisterConfirm" class="form-label">Confirm password</label>
            <input name="confirmPassword" type="password" class="form-control" id="inputPasswordRegisterConfirm" required>
        </div>
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Create account</button>
        </div>
    </form>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>