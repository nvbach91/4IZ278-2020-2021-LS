<?php require_once __DIR__ . '/includes/utils/baseHelper.php'; ?>
<?php require_once __DIR__ . '/config/config.php'; ?>
<?php require_once __DIR__ . '/includes/classes/UsersDB.php'; ?>
<?php

$errors = array();
$success = false;

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])) {

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email je neplatný");
    }

    if ($_POST['password'] != $_POST['passwordConfirm']) {
        array_push($errors, "Hesla nejsou shodná");
    }

    if (strlen($_POST['password']) < 6) {
        array_push($errors, "Heslo musí mít alespoň 6 znaků");
    }

    if (count($errors) == 0) {
        $userDB = new UsersDB();
        $result = $userDB->create(array('email' => $_POST['email'], 'password' => $_POST['password']));
        if ($result['success']) {
            $success = true;
        } else {
            array_push($errors, $result['msg']);
        }
    }

}


?>
<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/navigation.php'; ?>

    <div class="container py-5">

        <h1>Registrace</h1>

        <div class="col-4 mt-3 px-0">
            <?php foreach ($errors as $error): ?>
                <div role="alert" class="alert alert-danger"><?php echo $error; ?></div>
            <?php endforeach; ?>
            <?php if ($success) : ?>
                <div role="alert" class="alert alert-success">Registrace úspěšná</div>
            <?php endif; ?>
            <form class="row mt-3" method="post">
                <div class="col-auto">
                    <input name="email" type="text" class="form-control border-flat-bottom" id="inputEmail" placeholder="Email">
                </div>
                <div class="col-auto">
                    <input name="password" type="password" class="form-control border-flat-top border-flat-bottom" id="inputPassword" placeholder="Heslo">
                </div>
                <div class="col-auto">
                    <input name="passwordConfirm" type="password" class="form-control border-flat-top" id="inputPasswordConfirm" placeholder="Potvrzení hesla">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Registrovat</button>
                </div>
            </form>
        </div>

    </div>
    <div style="margin-bottom: 600px"></div>

<?php include __DIR__ . '/footer.php'; ?>