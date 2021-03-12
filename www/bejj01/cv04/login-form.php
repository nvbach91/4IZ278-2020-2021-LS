<?php

require __DIR__ . '/utils/utils.php';

$alerts = [];
$alertStyle = 'bg-danger text-white';
$formSubmitted = !empty($_POST);
$emailGet = isset($_GET['email']);
if ($emailGet) {
    $email = $_GET['email'];
}

if ($formSubmitted) {
    $email = trim(@$_POST['email']);
    $password = @$_POST['password'];
    $authentication = authenticateUser($email, $password);

    if (!$authentication['success']) {
        $alerts['auth'] = $authentication['message'];
    }
    else {
        header("Location: profile.php?email=$email");
        exit();
    }
}

?>

<?php include './includes/header.php'?>

<main class="container col-md-5">
    <div class="row justify-content-center">
        <h1>Login</h1>
    </div>
    <br>
    <div class="row justify-content-center">
        <?php if ($emailGet && @$_GET['from'] === 'registration'):?>
            <div class="alert bg-info text-light">
                <?php echo "Congratulations! You have been successfully registered. Now you can Log In."?>
            </div>
        <?php endif; ?>
        <?php if ($emailGet && @$_GET['from'] === 'profile'):?>
            <div class="alert bg-info text-light">
                <?php echo "You have been logged off"?>
            </div>
        <?php endif; ?>
        <?php if ($formSubmitted && !empty($alerts)): ?>
            <?php foreach($alerts as $alert): ?>
                <div class="alert <?php echo $alertStyle ?>">
                    <?php echo $alert?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="row justify-content-center">
        <form class="form-signin bg-dark" method="POST">
            <div class="form-group">
                <h5><label for="email">Email</label></h5>
                <input type="email" class="form-control <?php echo getInvalidClass('email', $alerts); ?>" id="email" placeholder="Enter your email address" name="email" value="<?php echo isset($email) ? $email : '' ?>">
            </div>
            <div class="form-group">
                <h5><label for="password">Password</label></h5>
                <input type="password" class="form-control <?php echo getInvalidClass('password', $alerts); ?>" id="password" placeholder="Enter password" name="password" value="<?php echo isset($password) ? $password : '' ?>">
            </div>
            <div class="divider"></div>
            <div class="row justify-content-center">
                <button class="btn btn-info" type="submit">Login</button>
            </div>
        </form>
    </div>
</main>

<?php include './includes/footer.php'?> 