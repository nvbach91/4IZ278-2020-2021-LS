<?php

function sendEmail($recipient, $subject, $message)
{
    $header = [
        'MIME-Version: 1.0',
        'Content-type: text/html, charset=utf-8',
        'Form: app@dev.com',
        'Reply=To: app@dev.com',
        'X-Mailer: PHP/8.0',
    ];
    $body = "
    <h1>$subject</h1>
    <p>$message</p>
    ";
    $mailResult = mail($recipient, $subject, $body, implode("\r\n", $header));
    return $mailResult;
}

function makeRegistration($data)
{

    $databaseFileName = __DIR__ . '/database/users.db';
    $userRecords = file($databaseFileName);
    $isExistingUser = false;
    foreach ($userRecords as $userRecord) {
        if (!$userRecord) {
            continue;
        }
        $fields = explode(';', $userRecord);
        // ['alex fedina', 'sas@mail.ru', '1234']
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
        return ['success' => false, 'message' => 'User already exists.'];
    }

    $userInformation = [
        $data['name'],
        $data['email'],
        $data['password'],
    ];
    $record = implode(';', $userInformation) . "\r\n";

    file_put_contents($databaseFileName, $record, FILE_APPEND);
    return ['success' => true, 'message' => 'Success'];

}

;

$invalidInputs = [];
$errors = [];

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm = htmlspecialchars(trim($_POST['confirm']));

    if (!$email) {
        array_push($invalidInputs, 'Email is empty!');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Email je invalid!');
    }
    if (($password) && (!preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password))){
        array_push($invalidInputs, 'Non-existent password!');
    }
    if ($password !== $confirm) {
        array_push($invalidInputs, 'Passwords do not match');
    }



    if (empty($invalidInputs)) {

        $registrationResult = makeRegistration($_POST);

        if ($registrationResult['success']) {
            //send email
            sendEmail($email, 'Registration confirmation', 'Thank you for your registration');
            // redirect user to login page
            header("Location: login.php?email=$email");
        } else {
            array_push($errors, $registrationResult['message']);
        }
    }
}

?>


<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/navigation.php'; ?>
    <main class="registration">
        <h1>Registration</h1>
        <?php foreach ($invalidInputs

        as $message): ?>
        <p><?php echo $message ?>
            <?php endforeach; ?>
            <?php foreach ($errors

            as $error): ?>
        <p><?php echo $error ?>
            <?php endforeach; ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="card-registration">
            <div class="form-group">
                <label for="name">Full Name</label><br>
                <input placeholder="name" name="name" type="text" id="name">
            </div>
            <div class="form-group">
                <label for="email">Email</label><br>
                <input placeholder="email" name="email" type="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label><br>
                <input placeholder="password" name="password" type="password" id="password">
                <small id="passwordHelp" class="form-text text-muted">Password must contain at least 8 characters, 1 lowercase, 1 uppercase letter and 1 number! </small>
            </div>
            <div class="form-group">
                <label for="confirm">Confirm password</label><br>
                <input placeholder="confirm" name="confirm" type="password" id="confirm">
            </div>
            <button type="submit" class="btn btn-success">Create an account</button>
        </form>
    </main>
<?php include __DIR__ . '/includes/foot.php'; ?>