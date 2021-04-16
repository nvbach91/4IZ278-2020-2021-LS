<?php require_once __DIR__ . '/includes/utils/baseHelper.php'; ?>
<?php require_once __DIR__ . '/config/config.php'; ?>
<?php require_once __DIR__ . '/includes/classes/UsersDB.php'; ?>
<?php

$errors = array();

if (isset($_POST['email']) && isset($_POST['password'])) {

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email je neplatný");
    }

    if (strlen($_POST['password']) < 6) {
        array_push($errors, "Heslo je neplatné");
    }

    if (count($errors) == 0) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $usersDB = new UsersDB();

        $users = $usersDB->fetchBy(array('where' => array('email' => $_POST['email'])));
        if (count($users) > 0) {
            if (password_verify($_POST['password'], $users[0]['password'])) {
                setcookie("user", $users[0]['ident'], time() + 3600);
                header("Location: " . BASE_URL );
                die();
            }
        }
        array_push($errors, "Tato kombinace hesla a mailu není známá");
    }

}


?>
<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/navigation.php'; ?>

<div class="container py-5">

    <h1>Přihlášení</h1>

    <div class="col-4 mt-3 px-0">
        <?php foreach ($errors as $error): ?>
            <div role="alert" class="alert alert-danger"><?php echo $error; ?></div>
        <?php endforeach; ?>
        <form class="row mt-3" method="post">
            <div class="col-auto">
                <input name="email" type="text" class="form-control border-flat-bottom" id="inputEmail" placeholder="Email">
            </div>
            <div class="col-auto">
                <input name="password" type="password" class="form-control border-flat-top" id="inputPassword" placeholder="Password">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Přihlásit se</button>
            </div>
        </form>
        <a href="register.php">Nemám uživatelský účet</a>
    </div>

</div>
<div style="margin-bottom: 600px"></div>

<?php include __DIR__ . '/footer.php'; ?>
