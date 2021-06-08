<?php

session_start();
require_once __DIR__ . '/lib/UserDB.php';
require __DIR__ . '/userRequired.php';

$success = false;

$errorMessages = [];
$userDB = new UserDB();

if (isset($_POST['user_info'])) {
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $phone = htmlspecialchars($_POST['phone']);


    if (empty($errorMessages)) {
        $change_client = $userDB->updateClient($_SESSION['user_id'], $name, $surname, $phone);

        $success = true;
    }
} elseif (isset($_POST['email_change'])) {
    $email = $_POST['email'];
    $confirmEmail = $_POST['email_confirm'];

    if ($email != $confirmEmail) {
        array_push($errorMessages, 'Your emails do not match.');
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($errorMessages, 'Please enter valid email address');
    }

    $change_email = $userDB->updateEmail($_SESSION['user_id'], $email);

    $success = true;
} elseif (isset($_POST['password_change'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['password_confirm'];

    if ($password != $confirmPassword) {
        array_push($errorMessages, 'Your passwords do not match.');
    } else if (strlen($password) < 5) {
        array_push($errorMessages, 'Your password must be at least 5 characters long.');
    }

    if (empty($errorMessages)) {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        if (empty($errorMessages)) {

            $change_password = $userDB->updatePassword($_SESSION['user_id'], $password);

            $success = true;
        }
    }
}

$user = $userDB->fetchUser($_SESSION['user_id']);

?>

<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <h1>My account</h1>
    <ul>
        <?php foreach ($errorMessages as $message) : ?>
            <p style="color:red;"><?php echo $message; ?></p>
        <?php endforeach; ?>
        <?php if ($success) : ?>
            <div class="success">You have successfully edited your data.</div>
        <?php endif; ?>
    </ul>
    <form method="POST">
        <h6 class="heading-small text-muted mb-4">User information</h6>
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" value="<?php if (!empty($user)) echo $user['name'] ?>" />
            <label for="name">Surname</label>
            <input class="form-control" id="surname" name="surname" value="<?php if (!empty($user)) echo $user['surname'] ?>" />
            <label for="name">Phone</label>
            <input class="form-control" id="phone" name="phone" value="<?php if (!empty($user)) echo $user['phone'] ?>" />
        </div>
        <button type="submit" name="user_info" class="btn btn-secondary">Save</button>
    </form>
    <hr class="my-4">
    <form method="POST">
        <h6 class="heading-small text-muted mb-4">Change email</h6>
        <div class="form-group">
            <label for="name">New email</label>
            <input class="form-control" id="email" name="email" value="<?= $user['email'] ?>" />
            <label for="name">New email (confirm)</label>
            <input class="form-control" id="email_confirm" name="email_confirm" value="<?= $user['email'] ?>" />
        </div>
        <button type="submit" name="email_change" class="btn btn-secondary">Save</button>
    </form>
    <hr class="my-4">
    <form method="POST">
        <h6 class="heading-small text-muted mb-4">Change password</h6>
        <div class="form-group">
            <label for="name">New password</label>
            <input class="form-control" id="password" name="password" value="Password should be at least 5 characters" />
            <label for="name">New password (confirm)</label>
            <input class="form-control" id="password_confirm" name="password_confirm" value="Password should be at least 5 characters" />
        </div>
        <button type="submit" name="password_change" class="btn btn-secondary">Save</button>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>