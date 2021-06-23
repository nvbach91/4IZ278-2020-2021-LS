<?php require __DIR__ . '/db/usersDB.php'; ?>
<?php 
if(!isset($_SESSION)){
    session_start();
}
$usersDB = NEW UsersDB();
$invalidInputs = [];

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Please enter your email');
    }

    if (!$password || strlen($password) < 8) {
        array_push($invalidInputs, 'Please enter your password');
    }

    if (empty($invalidInputs)) {
        $existing_user = $usersDB->findUser($email);
        if (@password_verify($password, $existing_user['password'])) {
            $_SESSION['user_id'] = $existing_user['id'];
            $_SESSION['user_email'] = $existing_user['email'];
            header('Location: index.php');
        } else {
           array_push($invalidInputs,"Wrong sign in credentials");
        }
    }
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];
}

?>
<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>
<main class="container-sm">
    <div class=" mb-2 text-center">
        <h2>Log in</h2>
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
    <?php if (isset($_GET['email']) && @$_GET['ref'] === 'registration') : ?>
        <div class="alert alert-success">You have successfully register</div>
    <?php endif; ?>
    <form class="row g-3 form-login" method="POST">
        <div class="col-md-12">
            <label for="inputEmailLogin" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="inputEmailLogin" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="col-md-12">
            <label for="inputPasswordLogin" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="inputPasswordLogin">
        </div>
        <div class="col-md-12 text-left">
           <p>Don't have an account yet?  <a href="registration.php">Register now</a></p>
        </div>
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Log in</button>
        </div>
    </form>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>