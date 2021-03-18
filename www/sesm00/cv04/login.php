<?php
require __DIR__ . '/includes/core.php';

$isSubmited = !empty($_POST);
$errors = array();
$successes = array();

if ($isSubmited) {

    $email = htmlspecialchars(trim($_POST["email"]));
    $password = trim($_POST["password"]);

    $isAuthenticated = authenticate(array('email' => $email, 'password' => $password));
    if ($isAuthenticated) {
        array_push($successes, "Uživatel přihlášen");
    } else {
        array_push($errors, "Kombinace emailu a hesla není platná");
    }

}


include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/navigation.php';
?>


<div class="login-page">
    <form method="POST" class="form-signin">
        <?php foreach ($successes as $success) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>
        <?php endforeach; ?>
        <?php foreach ($errors as $error) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="" value="<?php echo !empty($_GET['email']) ? $_GET['email'] : ""; ?>">
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</div>

<?php include __DIR__ . '/includes/foot.php'; ?>