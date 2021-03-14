<?php
if (!empty($_GET)) {
    $email = htmlspecialchars(trim($_GET['email']));
}

$isSubmitted = !empty($_POST);
$errors = [];
$success_message = "";

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    # validate email
    if (!$email) {
        array_push($errors, 'Please enter email.');
    }

    # validate password
    if (!$password) {
        array_push($errors, 'Please enter your password.');
    }

    $databaseFileName = __DIR__ . "/database/users.db";
    $lines = file($databaseFileName);
    $loginSuccess = false;
    $result = [];
    foreach ($lines as $line) {
        if (!$lines) {
            continue;
        }
        $fields = explode(';', trim($line));
        $user = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];

        if ($user['email'] === $_POST['email'] && $user['password'] === $_POST['password']) {
            $loginSuccess = true;
            break;
        }
    }

    if (!$loginSuccess) {
        array_push($errors, "Credentials didn't match.");
    }

    if (empty($errors)) {
        $success_message = 'You are logged in!';
    }
}

?>

<?php include 'include/header.php' ?>
<?php include __DIR__ . "/include/navigation.php" ?>
<main>
    <div class="row"><h1 class="m-3">Login</h1></div>
    <div class="row">
        <?php if (!$isSubmitted || $errors): ?>
        <?php if (isset($email)): ?>
            <h2 class="m-3">You have been successfully registered</h2>
        <?php endif ?>
        <div class="card w-50 m-3">
            <div class="m-3">
                <form method="post">
                    <div>
                        <label for="email" class="form-label">Email address</label>
                        <input name="email" value="<?php echo isset($email) ? $email : "" ?>" class="form-control"
                               id="email">
                    </div>
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <input name="password" value="<?php echo isset($password) ? $password : "" ?>"
                               class="form-control" id="password">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        </div>
        <?php endif ?>

        <?php if ($isSubmitted): ?>
            <?php if ($errors): ?>
                <h3 class="mx-3">Errors</h3>
                <?php foreach ($errors as $msg): ?>
                    <div class="mx-3 w-50">
                        <p><span class="badge bg-danger"><?php echo $msg ?></span></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="m-3 w-50">
                    <h3>
                        <?php echo $success_message ?>
                    </h3>
                </div>
            <?php endif ?>
        <?php endif ?>
    </div>
</main>
<?php include 'include/footer.php' ?>