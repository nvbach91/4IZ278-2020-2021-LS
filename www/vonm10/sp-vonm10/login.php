<?php require_once __DIR__ . '/db/UsersDB.php'; ?>
<?php require_once __DIR__ . '/config/global.php'; ?>
<?php

$invalidInputs = [];
$errors = [];

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $hashedPassword;
    $admin;
    $userId;

    if (!$email) {
        array_push($invalidInputs, 'Email is empty');
    }

    if (!$password) {
        array_push($invalidInputs, 'Password is empty');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Email is in invalid format');
    }

    if (empty($invalidInputs)) {
        $isExistingUser = false;
        $usersDB = new UsersDB();
        $userRecords = $usersDB->fetchAll();
        foreach ($userRecords as $userRecord) {
            if (!$userRecord) {
                continue;
            }

            if ($userRecord['email'] == $email) {
                $isExistingUser = true;
                $hashedPassword = trim($userRecord['password']);
                $admin = $userRecord['admin'];
                $userId = $userRecord['id'];
                break;
            }
        }

        if (!$isExistingUser) {
            array_push($errors, 'User does not exist');
        } else {
            if (password_verify($password, $hashedPassword)) {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['admin'] = $admin;
                $_SESSION['user_id'] = $userId;
                header('Location: /../~vonm10/beardwithme/index.php');
            } else {
                array_push($errors, 'Wrong passsword');
            }
        }
    }
}

?>



<?php require __DIR__ . '/incl/header.php'; ?>
<h1>Login</h1>
<?php foreach ($invalidInputs as $message) : ?>
    <p><?php echo $message; ?></p>
<?php endforeach; ?>
<?php foreach ($errors as $message) : ?>
    <p><?php echo $message; ?></p>
<?php endforeach; ?>
<form method="POST">
    <div>
        <label>Email</label>
        <input name="email">
    </div>
    <div>
        <label>Password</label>
        <input name="password">
    </div>
    <div>
        <button>Login</button>
    </div>
</form>
<form action="<?php echo URL . "/facebook/login.php"; ?>">
    <input type="submit" value="Login with Facebook" />
</form>
<?php require __DIR__ . '/incl/footer.php'; ?>