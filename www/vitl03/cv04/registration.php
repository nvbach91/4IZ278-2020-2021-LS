<?php
$msg = '';
$msgClass = '';
function sendEmail($recipient, $subject, $message)
{

    $header = [
        'MIME-Version_ 1.0',
        'Content-type: text/html, charset=utf-8',
        'From: app@dev.com',
        'Reply-To: app@dev.com',
        'X-Mailer: PHP/8.0',
    ];
    $body = "
        <h1>$subject</h1>
        <p>$message</p>
    ";
    return mail($recipient, $subject, $body, $header);
}

function makeRegistration($data)
{

    $databaseFileName = __DIR__ . '/database/user.db';

    $userRecords = file($databaseFileName);

    $isExistingUser = false;
    foreach ($userRecords as $userRecord) {
        if (!$userRecord) {
            continue;
        }
        $fields = explode(';', $userRecord);

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
        return ['success' => false];
    }

    $userInformation = [
        $data['name'],
        $data['email'],
        $data['password'],
    ];

    $record = implode(';', $userInformation) . "\n";

    file_put_contents($databaseFileName, $record, FILE_APPEND);

    return ['success' => true, 'message' => 'User was registered.'];
}

$errors = [];
$invalidInputs = [];
if (filter_has_var(INPUT_POST, 'submit')) {

    if (!empty($_POST)) {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));
        $confirm = htmlspecialchars(trim($_POST['confirm']));
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $msg = 'Please enter a valid email!';
            $msgClass = 'alert-danger';
        }

        if ($password !== $confirm) {
            array_push($invalidInputs, 'Passwords do not match!');
            $msg = "Passwords do not match!";
            $msgClass = 'alert-danger';
        }


        if (
            (!empty($name))
            && (!empty($email))
            && (!empty($password))
        ) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $msg = 'Please enter a valid email!';
                $msgClass = 'alert-danger';
            }
        } else {
            array_push($invalidInputs, 'Please fill in all fields!');
            $msg = 'Please fill in all fields!';
            $msgClass = 'alert-danger';
        }

        if (empty($invalidInputs)) {
            // provedeme registraci
            $registrationResult = makeRegistration($_POST);

            if ($registrationResult['success']) {
                // send email
                sendEmail($email, 'Registration confirmation', 'Thank you for your registration');
                // redirect user to login page
                header("Location: login.php?email=$email ");
            } else {
                array_push($errors, $registrationResult['message']);
                $msg = "User already exists.";
                $msgClass = 'alert-danger';
            }
        }
    }
}
?>



<?php include __DIR__ . '/includes/header.php' ?>
<?php include __DIR__ . '/includes/navigation.php' ?>



<div class="container">
    <h1>Registration</h1>
    <?php if ($msg != '') : ?>
        <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
    <?php endif; ?>

    <?php foreach ($errors as $error) : ?>
        <p><?php echo $error; ?></p>
    <?php endforeach; ?>

    <form class="form-signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" placeholder="name" value="<?php echo isset($name) ? $name : ''; ?>">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" name="email" placeholder="email" type="email" value="<?php echo isset($email) ? $email : ''; ?>">
        </div>
        <div class="form-group">
            <label>Passowrd</label>
            <input class="form-control" name="password" placeholder="password" type="password" value="<?php echo isset($password) ? $password : ''; ?>">
        </div>
        <div class="form-group">
            <label>Password Confirmation</label>
            <input class="form-control" name="confirm" placeholder="confirm" type="password" value="<?php echo isset($confirm) ? $confirm : ''; ?>">
        </div>
        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
    </form>
</div>
<?php include __DIR__ . '/includes/footer.php' ?>