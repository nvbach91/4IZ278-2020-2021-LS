<?php //require __DIR__ . '/Database.php'; 
?>
<?php
$invalidInputs = [];
$errors = [];
$msg = '';
$msgClass = '';

$pdo = new PDO(

    "mysql:host=localhost;dbname=vitl03;charset=utf8mb4",
    "vitl03",
    "eigheeLae4Aith9aiH"
);


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
            //$statement = $pdo->prepare('INSERT INTO users(email, password, privillage) VALUES (:email, :password, 3)');
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


<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="img/logoLV_white.png" alt="logo" width="40" height="40"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                    </li>
                <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'signin') ? ' active' : '' ?>">
                            <a class="nav-link" href="signin.php">Sign in</a>
                        </li>
            </ul>
        </div>
    </div>
</nav>

<body>

    <div class="container">
        <br>
        <h1>Fruit shop</h1>
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
            <button class="btn btn-lg btn-warning btn-block text-uppercase" type="submit">Create account</button>
        </form>
    </div>
    <div style="margin-bottom: 600px"></div>


    <?php include __DIR__ . '/includes/footer.php' ?>