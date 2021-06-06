<?php

session_start();
require __DIR__ . '/db.php';
require __DIR__ . '/user_required.php';

$success = false;

$errorMessages = [];

if (isset($_POST['user_info'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $ico = $_POST['ico'];


    if (empty($errorMessages)) {
        $statement = $pdo->prepare("
      UPDATE client SET
      name = :name,
      surname = :surname,
      phone = :phone,
      ico = :ico
      WHERE user_id = :user_id;
    ");
        $statement->execute([
            "user_id" => $_GET['user_id'],
            "name" => $name,
            "surname" => $surname,
            "phone" => $phone,
            "ico" => $ico,
        ]);

        $success = true;
    }
} elseif (isset($_POST['email_change'])) {
    $email = $_POST['email'];
    $confirmEmail = $_POST['email_confirm'];

    if ($email != $confirmEmail) {
        array_push($errorMessages,   'Your emails do not match.');
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($errorMessages,  'Please enter valid email address');
    }

    if (empty($errorMessages)) {
        $statement = $pdo->prepare("
      UPDATE user SET
      email = :email
      WHERE user_id = :user_id;
    ");
        $statement->execute([
            "user_id" => $_GET['user_id'],
            "email" => $email,
        ]);

        $success = true;
    }
} elseif (isset($_POST['password_change'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['password_confirm'];

    if ($password != $confirmPassword) {
        array_push($errorMessages,   'Your passwords do not match.');
    } else if (strlen($password) < 5) {
        array_push($errorMessages,  'Your password must be at least 5 characters long.');
    }

    if (empty($errorMessages)) {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        if (empty($errorMessages)) {
            $statement = $pdo->prepare("
      UPDATE user SET
      password = :npassword
      WHERE user_id = :user_id;
    ");
            $statement->execute([
                "user_id" => $_GET['user_id'],
                "password" => $hashPassword
            ]);

            $success = true;
        }
    }
}

$user = $pdo->prepare("SELECT * FROM user WHERE user_id = :user_id;");
$user->execute([
    'user_id' => $_GET['user_id']
]);

$user = $user->fetchAll()[0];


$client = $pdo->prepare("SELECT * FROM client WHERE user_id = :user_id;");
$client->execute([
    'user_id' => $_GET['user_id']
]);

$client = $client->fetchAll()[0];

?>


<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <br> <br>
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
            <input class="form-control" id="name" name="name" value="<?php if (!empty($client)) echo $client['name'] ?>" />
            <label for="name">Surname</label>
            <input class="form-control" id="surname" name="surname" value="<?php if (!empty($client)) echo $client['surname'] ?>" />
            <label for="name">Phone</label>
            <input class="form-control" id="phone" name="phone" value="<?php if (!empty($client)) echo $client['phone'] ?>" />
            <label for="name">ICO</label>
            <input class="form-control" id="ico" name="ico" value="<?php if (!empty($client)) echo $client['ico'] ?>" />
        </div>
        <button type="submit" name="user_info" class="btn btn-primary">Save</button>
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
        <button type="submit" name="email_change" class="btn btn-primary">Save</button>
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
        <button type="submit" name="password_change" class="btn btn-primary">Save</button>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>