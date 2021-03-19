<?php include __DIR__ . '/lib/usersDb.php'; ?>
<?php

$errors = [];

function sendEmail($recipient, $subject, $message) {
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html, charset=utf-8',
        'From: kadm08@vse.cz',
        'Reply-To: kadm08@vse.cz',
        'X-Mailer: PHP/8.0',
    ];
    $msg = "
        <h1>Registration confirmation</h1>
        <p>$message</p>
    ";
    return mail($recipient, $subject, $msg, implode("\r\n", $headers));
}

function registerNewUser($name, $email, $password) {
    if (emailExists($email)) {
        return [
            'success' => false,
            'message' => "User already exists!",
        ];
    }

    addUser([
        'name' => $name,
        'email' => $email,
        'password' => $password,
    ]);
    return [
        'success' => true,
        'message' => null,
    ];
}

if (!empty($_POST)) {
    $name =  htmlspecialchars(trim($_POST['name']));
    $email =  htmlspecialchars(trim($_POST['email']));
    $password =  htmlspecialchars(trim($_POST['password']));
    $confirmPassword =  htmlspecialchars(trim($_POST['confirm']));

    if ($password !== $confirmPassword) {
        array_push($errors, 'Passwords do not match');
    }

    if (!$name) {
        array_push($errors, 'Please enter your name');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Please use a valid email');
    }

    if (strlen($password) < 8) {
        array_push($errors, 'Passwords too short');
    }

    if (empty($errors)) {
        $registrationResult = registerNewUser($name, $email, $password);
        if ($registrationResult['success']) {
            sendEmail($email, 'Registration was a success', "Hello, thank you for your registration, ...");
            header("Location: login.php?email=$email");
        } else {
            array_push($errors, $registrationResult['message']);
        }
    }
}


$nameValue = array_key_exists("name", $_POST) ? htmlspecialchars($_POST["name"]) : "";
$emailValue = array_key_exists("email", $_POST) ? htmlspecialchars($_POST["email"]) : "";
?>


<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/includes/navigation.php'; ?>
<main>
    <h1>Registration</h1>
    <?php foreach($errors as $message): ?>
        <p><?php echo $message; ?></p>
    <?php endforeach; ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" novalidate>
        <input placeholder="name" name="name" value="<?php echo $nameValue ?>"><br>
        <input placeholder="email" name="email" type="email" value="<?php echo $emailValue ?>"><br>
        <input placeholder="password" name="password" type="password"><br>
        <input placeholder="confirm password" name="confirm" type="password"><br>
        <button>Register</button>
    </form>
</main>
<?php include __DIR__ . '/includes/foot.php'; ?>
    