<?php

require "utils.php";

$isSubmitted = !empty($_POST);
$invalidInputs = [];

if ($isSubmitted) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (!$email) {
        array_push($invalidInputs, 'Email is empty');
    }

    if (!$password) {
        array_push($invalidInputs, 'Password is empty');
    }


    if (empty($invalidInputs)) {
        $databaseFileName = __DIR__ . '/database/users.db';
        $user = exists($databaseFileName, $email);
        if ($user) {
            if ($user['password'] === $password) {
                header("Location: index.php");
            } else {
                array_push($invalidInputs, 'Wrong password');
            }
        } else {
            array_push($invalidInputs, 'User does not exist');
        }
    }
    makeAlerts();
}
$email = array_key_exists('email', $_GET) ? $_GET['email'] : null;
?>

<?php include __DIR__ . '/includes/header.php' ?>
<main>
    <h1>Login</h1>
    <?php if ($isSubmitted) : ?>
        <div class="alert <?php echo $alert ?>" role="alert">
            <?php echo $alertMessages ?>
        </div>
    <?php endif; ?>
    <form class="form-signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" value="<?php echo $email ?>" class="form-control" id="email">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</main>
<?php include __DIR__ . '/includes/footer.php' ?>