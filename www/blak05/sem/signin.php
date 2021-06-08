<?php require __DIR__ . '/db/usersDB.php' ?>
<?php
    $error = "";
    if (!empty($_POST)) {

        $username = htmlspecialchars($_POST['inputUsername']);
        $email = htmlspecialchars($_POST['inputEmail']);
        $password = htmlspecialchars($_POST['inputPassword']);
        $address= htmlspecialchars($_POST['inputAddress']);
        $city = htmlspecialchars($_POST['inputCity']);
        $psc = htmlspecialchars($_POST['inputPsc']);
        $letter = 0;
        if (isset($_POST['inputLetter'])) {
            $letter = 1;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        session_start();
        $usersDB = new UsersDB();
        $numberOfSameMails = $usersDB->fetchCount($email);
        if($numberOfSameMails > 0){
            $error = "<div class='alert alert-danger' role='alert'> Tento mail už v naší databázi! </div>";
        }else{
            $newuserDB = new UsersDB();
            $user = $newuserDB->create([$username, $email, $address, $city, $psc, $hashedPassword, $letter]);
            $userData = $usersDB->fetch($email);
            $_SESSION['user'] = $email;
            $_SESSION['priv'] = $userData['priv'];
            header('Location: index.php');
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
<body class="text-center bg-dark">
    <div class="boxik" style="width: 70%;">
    <form class="row g-3 form-signin" action="#" method="POST">
        <a href="index.php"><img class="mb-4" src="./img/logo.png" alt="" width="100" height="72"></a>
        <h1 class="h3 mb-3 font-weight-normal">Zaregistrujte se!</h1>
        <?php echo $error != null ? $error : "" ?>
        <div class="col-12">
            <label for="inputUsername" class="form-label">Celé jméno</label>
            <input type="text" class="form-control" name="inputUsername" placeholder="Jan Novák" required>
        </div>
        <div class="col-md-6">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" name="inputEmail" required>
        </div>
        <div class="col-md-6">
            <label for="inputPassword" class="form-label">Heslo</label>
            <input type="password" class="form-control" name="inputPassword" required>
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Vaše Adresa</label>
            <input type="text" class="form-control" name="inputAddress" placeholder="Miloše Zemana 1829/11" required>
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">Město</label>
            <input type="text" class="form-control" name="inputCity" placeholder="Praha 1" required>
        </div>
        <div class="col-md-6">
            <label for="inputPsc" class="form-label">PSČ</label>
            <input type="text" class="form-control" name="inputPsc" placeholder="11000" inputmode="numeric" pattern="[0-9]{5}" required>
        </div>
        <div class="col-auto offset-sm-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="inputLetter">
                <label class="form-check-label" for="gridCheck">
                    Mám zájem o newsletter!
                </label>
            </div>
        </div>
        <div class="col-12">
        <button class="btn btn-lg btn-outline-dark btn-warning btn-block" type="submit">Zaregistrovat!</button>
        </div>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>