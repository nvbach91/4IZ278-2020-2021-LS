<?php

$isSubmitted = !empty($_POST);
$errors = [];
$success_message = "";

function sendEmail($recipient, $subject, $message)
{
    $headers = [
        'MIME-version: 1.0',
        'Content-type: text/html, charset=utf-8',
        'From: app@dev.com',
        'Reply-To: app@dev.com',
        'X-mailer: PHP/8.0',
    ];
    $msg = "<h1>Registration Confirmation</h1><p>$message</p>";
    return mail($recipient, $subject, $msg, implode("\r\n", $headers));
}

function makeRegistration($data): array
{
    $databaseFileName = __DIR__ . "/database/users.db";

    $lines = file($databaseFileName);
    $userExists = false;
    $result = [];
    foreach ($lines as $line) {
        if (!$lines) {
            continue;
        }
        $fields = explode(';', $line);
        $user = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];

        if ($user['email'] === $data['email']) {
            $userExists = true;
            break;
        }
    }

    if (!$userExists) {

        $userInformation = [
            $data['name'],
            $data['email'],
            $data['password'],
        ];
        $newRecord = implode(';', $userInformation) . "\r\n";

        file_put_contents($databaseFileName, $newRecord, FILE_APPEND);
        $result['state'] = 'success';
        $result['message'] = 'User successfully registered.';
    } else {
        $result['state'] = 'Failure';
        $result['message'] = 'User with specified email already exists.';
    }

    return $result;
}


if (!empty($_POST)) {
    $name = htmlspecialchars(($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirmPassword']));

    # validate name
    if (!$name) {
        array_push($errors, 'Please enter your name.');
    } elseif (!preg_match('/^.{1,30}$/', $name)) {
        array_push($errors, 'Name should be under 30 characters.');
    }

    # validate email
    if (!$email) {
        array_push($errors, 'Please enter email.');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Invalid email.');
    }

    # validate password
    if (!$password) {
        array_push($errors, 'Please enter your password.');
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
        array_push($errors, 'Password should be at alphanumeric and at least 8 characters long.');
    }

    if ($password !== $confirmPassword) {
        array_push($errors, "Passwords didn't match.");
    }

    if (empty($errors)) {
        $success_message = 'Success!';
        $registrationResult = makeRegistration($_POST);
        if ($registrationResult['state'] === 'success') {
            sendEmail($email, 'PHP CV04: Registration successful', 'You have been successfully registered.');
            header("Location: login.php?email=$email");
        } else {
            array_push($errors, $registrationResult['message']);
        }
    }


}


?>

<?php include 'include/header.php' ?>
<?php include __DIR__ . "/include/navigation.php" ?>
<main>
    <div class="row"><h1 class="m-3">Registration</h1></div>
    <div class="row">
        <div class="card w-50 m-3">
            <div class="m-3">
                <form method="post">
                    <div>
                        <label for="name" class="form-label">First name</label>
                        <input name="name" value="<?php echo isset($name) ? $name : "" ?>"
                               class="form-control" id="name">
                    </div>
                    <div>
                        <label for="email" class="form-label">Email address</label>
                        <input name="email" value="<?php echo isset($email) ? $email : "" ?>" class="form-control"
                               id="email">
                    </div>
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <input name="password" value="<?php echo isset($password) ? $password : "" ?>"
                               class="form-control" id="password">
                    </div>
                    <div>
                        <label for="confirmPassword" class="form-label">Password</label>
                        <input name="confirmPassword"
                               value="<?php echo isset($confirmPassword) ? $confirmPassword : "" ?>"
                               class="form-control" id="confirmPassword">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        </div>

        <?php if ($isSubmitted): ?>
            <h2 class="m-3">You have submitted the form</h2>
            <?php if ($errors): ?>
                <h3 class="mx-3">Errors</h3>
                <?php foreach ($errors as $msg): ?>
                    <div class="mx-3 w-50">
                        <p><span class="badge bg-danger"><?php echo $msg ?></span></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="m-3 w-50">
                    <h3>
                        <?php echo $success_message ?>
                    </h3>
                </div>
            <?php endif ?>
        <?php endif ?>
    </div>
</main>
<?php include 'include/footer.php' ?>

