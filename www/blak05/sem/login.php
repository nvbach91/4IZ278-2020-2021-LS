<?php require __DIR__ . '/db/usersDB.php' ?>
<?php 
    session_start();
    $error = "";
    if (!empty($_SESSION['user'])){
        $error = "Uživatel " . $_SESSION['user'] . " je již přihlášen";
    }
    if (!empty($_GET['msg']) && ($_GET['msg']=1)){
        $error = "Omlouváme se, ale před nákupem je třeba se přihlásit.";
    }
    if (!empty($_POST)) {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $usersDB = new UsersDB();
        $loginUser = $usersDB->fetchCount($email);
        $userData = $usersDB->fetch($email);
        if($loginUser == 0){
            $error = "<div class='alert alert-danger' role='alert'> Tento mail není v naší databázi! </div>";
        }elseif(password_verify($password, $userData['password'])){
            $_SESSION['user'] = $email;
            $_SESSION['priv'] = $userData['priv'];
            header("Location: index.php");
        }else{
            $error = "<div class='alert alert-danger' role='alert'> Your password is wrong </div>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Příhlášení - Pivotéka Modřany - Zdraví, úsměv, sílu!</title>
     <!-- Bootstrap CSS -->
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
     <link href="incl/style.css" rel="stylesheet">
     <link href="incl/login.css" rel="stylesheet">
</head>
<body class="text-center bg-dark" >
    <div class="border mb-4 boxik text-center" style="width: 70%;">
        <form class="form-signin" action="#" method="POST">
            <a href="index.php"><img class="mb-4" src="./img/logo.png" alt="" width="100" height="72"></a>
            <h1 class="h3 mb-3 font-weight-normal">Přihlaš se!</h1>
            <p class="fw-bold text-danger"><?php echo $error != null ? $error : "" ?></p>
            <label for="email" class="sr-only form-label">Váš email:</label>
            <input type="email" name="email" class="form-control" placeholder="Emailová adresa" required autofocus>
            <label for="password" class="sr-only form-label">Vaše heslo:</label>
            <input type="password" name="password" class="form-control" placeholder="Heslo" required>
            <button class="btn btn-lg btn-outline-dark btn-warning btn-block" type="submit">Přihlásit se</button>
            <br><br>
            <a href="signin.php" class="text-primary">Chci si založit účet</a>
        </form> 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>