<?php require __DIR__ . '/db.php' ?>
<?php 
    session_start();
    $error = "";
    if (!empty($_POST)) {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE email = :email";
        $statement = $pdo->prepare($sql);
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();

        if(password_verify($password, $user['password'])){
            $_SESSION['username'] = $user['email'];
            if($user['privilege'] == 2) {
                setcookie('privilege', 2, time() + 3600);
            }
            $pageOffset = @$_COOKIE['offset'];
            header("Location: index.php?offset=$pageOffset");
        }else{
            $error = "<div class='alert alert-danger' role='alert'> Your password is wrong </div>";
        }
    }
?>
<?php require __DIR__ . '/incl/header.php'; ?>
    <style>
        .boxik{
            max-width: 400px;
            margin: 2.5rem auto;
            padding: 20px;
        }
        button{
            margin-top: 0.5rem;
        }
    </style>
    <title>Login In!</title>
  </head>
  <body>
  <h4 style="padding: 50px;" class="text-danger text-center"><?php echo !empty($_GET) ? "For shopping you need to log in" : "" ?></h4>
  <div class="border p3 mb-4 boxik text-center">
    <form action="#" method="POST">
    <h2>Login</h2>
        <?php echo $error != null ? $error : "" ?>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" class="form-control" type="name" required>
            <label class="form-label">Password</label>
            <input name="password" class="form-control" type="password" required>
            <button type="submit" class="btn btn-lg btn-dark">Login</button>
            <br><br>
            <a href="registration.php" class="text-primary">I want my own account</a>
        </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>