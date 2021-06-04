<?php

require __DIR__ . '/utils/utils.php';

$errors = [];

$submittedForm = !empty($_POST);
if ($submittedForm) {
    $name = trim(@$_POST['name']);
    $email = trim(@$_POST['email']);
    $password = @$_POST['password'];
    $confirm = @$_POST['confirm'];

    if (!$name) {
        $errors['name'] = '*Vyplňte jméno';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = '*Vyplňte validní email';
    }

    if ($password !== $confirm || strlen($password) < 8 || strlen($confirm) < 8) {
        $errors['password'] = '*Vyplňte validní heslo';
        $errors['confirm'] = '*Heslo se neshoduje';
    }

    if (empty($errors)) {
        $registerNewUser = registerNewUser($_POST, false);
        if (!$registerNewUser['success']) {
            $errors['registration'] = $registerNewUser['msg'];
        }
    }

    if (empty($errors)) {
        sendEmail($email, 'Registration confirmation');
        header('Location: login?ref=registration');
        exit();
    }
}

?>
<?php require __DIR__ . '/includes/head.php'; ?>
<?php require __DIR__ . '/includes/navbar.php'; ?>
    <main class="container-fluid" id="mainRegister">
        <div class="row justify-content-md-center my-bg formHeight">
            <div class="col-md-4">
                <div class="card text-center formCard">
                    <h1 class="text-center">Registrace</h1>
                    <div class="row justify-content-center">
                        <form class="form-registration" method="POST">
                            <div class="form-group">
                                <label>Jméno <?php echo isset($errors["name"]) ? "<small class='errorColor'>" . $errors["name"] . "</small>" : "" ?></label>
                                <input class="form-control<?php echo getInputValidClass('name', $errors); ?>"
                                       name="name"
                                       value="<?php echo @$name; ?>" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Email <?php echo isset($errors["email"]) ? "<small class='errorColor'>" . $errors["email"] . "</small>" : "" ?></label>
                                <input class="form-control<?php echo getInputValidClass('email', $errors); ?>"
                                       name="email"
                                       value="<?php echo @$email; ?>" type="email" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Heslo <small>(At least 8
                                        characters)</small> <?php echo isset($errors["password"]) ? "<small class='errorColor'>" . $errors["password"] . "</small>" : "" ?>
                                </label>
                                <input class="form-control<?php echo getInputValidClass('password', $errors); ?>"
                                       name="password"
                                       value="<?php echo @$password; ?>" type="password" autocomplete="off">
                                <label>Potvrzení
                                    hesla <?php echo isset($errors["confirm"]) ? "<small class='errorColor'>" . $errors["confirm"] . "</small>" : "" ?></label>
                                <input class="form-control<?php echo getInputValidClass('confirm', $errors); ?>"
                                       name="confirm"
                                       value="<?php echo @$confirm; ?>" type="password" autocomplete="off">
                            </div>
                            <?php echo isset($errors["registration"]) ? "<small class='errorColor'>" . $errors["registration"] . "</small></br>" : "" ?>
                            <div class="form-group mt-10">
                                <button class="btn btn-primary" type="submit">
                                    Registrovat
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require __DIR__ . '/includes/foot.php'; ?>