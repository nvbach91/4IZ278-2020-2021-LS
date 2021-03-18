<?php
$alertType = 'alert-danger';
$invalidInputs = [];
$alertMessages = [];
function sendEmail($recipient, $subject, $message) {
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html, charset=utf-8',
        'From: app@dev.com',
        'Reply-To: app@dev.com',
        'X-Mailer: PHP/8.0',
    ];
    $msg = "
        <h1>Registration confirmation</h1>
        <p>$message</p>
    ";
    return mail($recipient, $subject, $msg, implode("\r\n", $headers));
}

function makeRegistration($data) {
    $databaseFileName = getcwd().'/database/users.db';

    $lines = file($databaseFileName);
    $isExistingUser = false;
    $success = false;
    $message = '';
    foreach ($lines as $line) {
        if (!$line) {
            continue;
        }
        //'VIET BACH NGUYEN;nvbach91@gmail.com;Abcd1234'
        $fields = explode(';', $line);
        //['VIET BACH NGUYEN', 'nvbach91@gmail.com', 'Abcd1234']
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
    
        // vyrobit zaznam ve stringu
        $newRecord = implode(';', $userInformation) . "\r\n";
    
        // vlozit do souboru
        file_put_contents($databaseFileName, $newRecord, FILE_APPEND);
        $success = true;
    }
    $result = [
        'success' => $success,
        'message' => $message,
    ];

    return $result;
}

$submittedForm = !empty($_POST);  
if ($submittedForm) {
    $invalidInputs = [];
    $alertMessages = [];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm'];

    if (!$email) {
        array_push($alertMessages, 'Missing email field');
        array_push($invalidInputs, 'email');
    }

    if (!$name) {
        array_push($alertMessages, 'Missing name field');
        array_push($invalidInputs, 'name');
    }

    if (!$password) {
        array_push($alertMessages, 'Missing password field');
        array_push($invalidInputs, 'password');
    }

    if (!$confirmPassword) {
        array_push($alertMessages, 'Missing confirm password field');
        array_push($invalidInputs, 'confirm');
    }

    if (!$alertMessages) {
        if ($password !== $confirmPassword) {
            array_push($alertMessages, 'Passwords do not match!');
        }
    }


    if (empty($invalidInputs)) {
        // provest registraci
        $registrationResult = makeRegistration($_POST);
        if ($registrationResult['success']) {
            // poslat oznamovaci email o uspesne registraci
            // presmerovat uzivatele na login
            sendEmail($email, 'My Awesome App: Registration was a success', "Hello, thank you for your registration, ...");

            header("Location: login.php?email=$email");
        } else {
            array_push($alertMessages, $registrationResult['message']);
        }
    }
}

?>


<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/navigation.php'; ?>
<main>
    <h1>Registration</h1>
    <?php if ($submittedForm): ?>
        <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
    <?php endif; ?>  
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" value="<?php echo isset($email) ? $email : '' ?>">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Name:</label>
            <input type="text" name="name" class="form-control<?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>" value="<?php echo isset($name) ? $name : '' ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password:</label>
            <input type="password" name="password" class="form-control<?php echo in_array('password', $invalidInputs) ? ' is-invalid' : '' ?>" value="<?php echo isset($password) ? $password : '' ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password:</label>
            <input type="password" name="confirm" class="form-control<?php echo in_array('confirm', $invalidInputs) ? ' is-invalid' : '' ?>" value="<?php echo isset($confirmPassword) ? $confirmPassword : '' ?>">
        </div>
        <button class="btn btn-primary">Sign up</button>
    </form>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
    
