<?php
session_start();
require __DIR__ . '/db.php';

$errorMessages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        array_push($errorMessages, "Please enter your email.");
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    if (empty($_POST["password"])) {
        array_push($errorMessages, "Please enter your password.");
    } else {
        $password = htmlspecialchars($_POST["password"]);
    }

    if (empty($errorMessages)) {
        $login = $pdo->prepare(
            "
            SELECT * FROM user WHERE email = :email"
        );
        $login->execute([
            'email' => $email
        ]);
        $user = $login->fetchAll()[0];

        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['type'] = $user['type'];

            $get_client = $pdo->prepare(
                "
                    SELECT * FROM client WHERE user_id = :user_id"
            );
            $get_client->execute([
                'user_id' => $user['user_id']
            ]);
            $client = $get_client->fetchAll()[0];
            $_SESSION['client_id'] = $client['client_id'];

            header('Location: index.php');
        } else {
            $errors['password'] = 'Wrong user or password! Try again.';
        }
    }
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<br></br>er">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Sign In</h5>
                    <?php foreach ($errorMessages as $message) : ?>
                        <p style="color:red;"><?php echo $message; ?></p>
                    <?php endforeach; ?>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <form class="form-signin" method="POST">
                            <div class="form-group">
                                <label for="password">Email</label>
                                <input class="form-control<?php echo isset($errors['email']) ? ' is-invalid' : ''; ?>" value="<?php echo @$_POST['email']; ?>" placeholder="Enter your email address" name="email" id="email">
                                <?php if (isset($errors['email'])) : ?>
                                    <small class="error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <?php echo $errors['email'] ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control <?php echo isset($errors['password']) ? ' is-invalid' : ''; ?>" placeholder="Enter password" name="password" id="password" type="password">
                                <?php if (isset($errors['password'])) : ?>
                                    <small class="error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <?php echo $errors['password'] ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                            <div class="row justify-content-center">
                                <button class="btn btn-light px-5  shadow-sm" type="submit">Log In</button>
                            </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>