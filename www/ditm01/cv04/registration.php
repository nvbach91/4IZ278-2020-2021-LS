<?php
$invalidInputs = [];
$errors = [];
function sendEmail($recepient, $subject, $message)
{
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html, charset=utf-8',
        'From: ditm01@vse.cz',
        'Reply-To: ditm01@vse.cz',
        'X-Mailer: PHP/8.0',
    ];
    $msg = "<h1>Registration confirmation</h1><p>$message</p>";
    return mail($recepient, $subject, $msg, implode("\r\n", $headers));
}

function makeRegistration($data) {
    $databaseFileName = './database/users.db';

    $lines = file($databaseFileName);

    $isExistingUser = false;
    $success = false;
    $message = '';
    foreach ($lines as $line) {
        if (!$line) {
            continue;
        }
        $fields = explode(';', $line);
        $user = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];
        if ($user['email'] === $data['email']) {
            $isExistingUser = true;
            break;
        }
    }

    if ($isExistingUser) {
        $message = 'User already exists';
    }

    if (!$isExistingUser) {
        $userInformation = [
            $data['name'],
            $data['email'],
            $data['password'],
        ];

        $newRecord = implode(";", $userInformation) . "\r\n";

        file_put_contents($databaseFileName, $newRecord, FILE_APPEND);
        $success = true;
    }
    $result = [
        'success' => $success,
        'message' => $message,
    ];

    return $result;
}


if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirm']));

    if (!$name) {
        array_push($invalidInputs, 'Please enter your name');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Please enter valid email');
    }

    if (!$password || strlen($password) < 8) {
        array_push($invalidInputs, 'Please enter valid password');
    }

    if ($password !== $confirmPassword) {
        array_push($invalidInputs, 'Passwords do not match');
    }

    if (empty($invalidInputs)) {
        $registrationResult = makeRegistration($_POST);
        if ($registrationResult['success']) {
            sendEmail($email, "My Awesome App: Registration was a success", "Hello, Thank you for your registration ...");
            header("Location: login.php?ref=registration&email=$email");
        } else {
            array_push($errors, $registrationResult['message']);
        }
    }
}
?>


<?php include './includes/header.php' ?>
<?php include './includes/navigation.php' ?>
<main>
    <?php foreach ($invalidInputs as $message) : ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php endforeach; ?>
    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endforeach; ?>
    <h1 class="title">Registration</h1>
    <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label>Name</label>
            <input name="name" class="form-control" value="<?php echo isset($name) ? $name : '' ?>">
            <small class="fst-italic">Example: John Smith</small>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input name="email" type="email" class="form-control" value="<?php echo isset($email) ? $email : '' ?>">
            <small class="fst-italic">Example: example@mail.com</small>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input name="password" type="password" class="form-control">
            <small class="fst-italic">Password must be at least 8 characters</small>
        </div>
        <div class="form-group">
            <label>Confirm password</label>
            <input name="confirm" type="password" class="form-control">
        </div>
        <div class="col text-center">
            <button class="btn btn-primary">Sign up</button>
        </div>
    </form>
</main>
<?php include './includes/footer.php' ?>