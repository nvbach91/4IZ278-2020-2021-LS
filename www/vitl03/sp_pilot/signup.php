<?php require __DIR__ . '/config.php'; ?>
<?php
$invalidInputs = [];
$errors = [];
$msg = '';
$msgClass = '';


if ('POST' == $_SERVER['REQUEST_METHOD']) {


    $email = htmlspecialchars(trim(($_POST['email'])));
    $password = htmlspecialchars(trim(($_POST['password'])));

    if (!$email) {
        array_push($invalidInputs, 'Email is empty');
        $msg = 'Email is empty';
        $msgClass = 'alert-danger';
    }

    if (!$password) {
        array_push($invalidInputs, 'Password is empty');
        $msg = 'Password is empty';
        $msgClass = 'alert-danger';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Email is in invalid format');
        $msg = 'Email is in invalid format';
        $msgClass = 'alert-danger';
    }

    if (empty($invalidInputs)) {
        $isExistingUser = false;

        $statement = $pdo->prepare('SELECT * FROM users');
        $statement->execute();
        $userRecords = $statement->fetchAll();
        foreach ($userRecords as $userRecord) {
            if (!$userRecord) {
                continue;
            }
            if ($userRecord['email'] == $email) {
                $isExistingUser = true;
                break;
            }
        }

        if ($isExistingUser) {
            array_push($errors, 'User already exists');
            $msg = 'User already exists';
            $msgClass = 'alert-danger';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $statement = $pdo->prepare('INSERT INTO users(email, password) VALUES (:email, :password)');
            $statement->execute([
                'email' => $email,
                'password' => $hashedPassword
            ]);
            header('Location: signin.php');
        }
    }
}

?>


<?php include __DIR__ . '/includes/header.php' ?>

<body>

    <div class="container">
        <br>
        <h2>Signup</h2>
        <?php if ($msg != '') : ?>
        <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
    <?php endif; ?>

        <form class="form-signin" method="POST">
            <div class="form-label-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
            </div>
            <div class="form-label-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required="">
            </div>
            <br>
            <button class="button-red text-uppercase" type="submit">Create account</button>
        </form>
    </div>
    <div style="margin-bottom: 600px"></div>


    <?php include __DIR__ . '/includes/footer.php' ?>