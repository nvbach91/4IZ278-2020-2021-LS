<?php require __DIR__ . '/db.php' ?>
<?php 
    $error = "";
    if (!empty($_POST)) {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        session_start();
        $numberOfSameMails = $pdo->query("SELECT COUNT(id) FROM users WHERE email='$email'")->fetchColumn();
        if($numberOfSameMails > 0){
            $error = "<div class='alert alert-danger' role='alert'> This email is already in our db! </div>";
        }else{
            $sql = "INSERT INTO users (email, password, privilege) VALUES (?,?,1)";
            $pdo->prepare($sql)->execute([$email, $hashedPassword]);

            $_SESSION['username'] = $email;
            $pageOffset = @$_COOKIE['offset'];
            echo $_SESSION['username'];
            header("Location: index.php?offset=$pageOffset");
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

    <title>Register now!</title>
  </head>
  <body><div class="border p3 mb-4 boxik text-center">
    <form action="#" method="POST">
    <h2>Create new account</h2>
    <?php echo $error != null ? $error : "" ?>
        <div class="mb-3">
            <label class="form-label">Your email</label>
            <input name="email" class="form-control" type="name" required>
            <label class="form-label">Your password</label>
            <input name="password" class="form-control" type="password" required>
            <button type="submit" class="btn btn-lg btn-dark">Create account</button>
        </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>