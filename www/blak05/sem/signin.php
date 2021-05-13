<?php require __DIR__ . '/db/usersDB.php' ?>
<?php
    $error = "";
    if (!empty($_POST)) {

        $username = $_POST['inputUsername'];
        $email = $_POST['inputEmail'];
        $password = $_POST['inputPassword'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        session_start();
        $usersDB = new UsersDB();
        $numberOfSameMails = $usersDB->fetch($email);
        if($numberOfSameMails > 0){
            $error = "<div class='alert alert-danger' role='alert'> Tento mail už v naší databázi! </div>";
        }else{
            $newuserDB = new UsersDB();
            $user = $newuserDB->create([$username, $email, $hashedPassword]);

            $_SESSION['username'] = $email;
            echo $_SESSION['username'];
            header("Location: index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace - Pivotéka Modřany - Zdraví, úsměv, sílu!</title>
     <!-- Bootstrap CSS -->
     <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
     <link href="incl/style.css" rel="stylesheet">
     <link href="incl/login.css" rel="stylesheet">
</head>
<body class="text-center bg-dark" >
    <form class="form-signin boxik" action="#" method="POST">
      <a href="index.php"><img class="mb-4" src="./img/logo.png" alt="" width="100" height="72"></a>
      <h1 class="h3 mb-3 font-weight-normal">Zaregistrujte se!</h1>
      <?php echo $error != null ? $error : "" ?>
      <label for="inputEmail" class="sr-only">Uživatelské jméno:</label>
      <input type="name" name="inputUsername" class="form-control" placeholder="Uživatelské jméno" required autofocus>
      <label for="inputEmail" class="sr-only">Váš email:</label>
      <input type="email" name="inputEmail" class="form-control" placeholder="Emailová adresa" required autofocus>
      <label for="inputPassword" class="sr-only">Vaše heslo:</label>
      <input type="password" name="inputPassword" class="form-control" placeholder="Heslo" required>
      <button class="btn btn-lg btn-outline-dark btn-warning btn-block" type="submit">Registrovat</button>
    </form>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>