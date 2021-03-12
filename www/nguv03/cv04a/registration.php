<?php
$invalidInputs = [];
$errors = [];
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
    $databaseFileName = __DIR__ . '/database/users.db';

    $lines = file($databaseFileName);
    /*  [
            'VIET BACH NGUYEN;nvbach91@gmail.com;Abcd1234',
            'VIET BACH NGUYEN;potpod@seznam.cz;1234',
            'VIET BACH NGUYEN;abc@def.com;1234',
            '',
        ]
    */
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

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm'];

    if ($password !== $confirmPassword) {
        array_push($invalidInputs, 'Passwords do not match');
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
            array_push($errors, $registrationResult['message']);
        }
    }
}

?>


<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/includes/navigation.php'; ?>
<main>
    <h1>Registration</h1>
    <?php foreach($invalidInputs as $message): ?>
        <p><?php echo $message; ?></p>
    <?php endforeach; ?>
    <?php foreach($errors as $error): ?>
        <p><?php echo $error; ?></p>
    <?php endforeach; ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input placeholder="name" name="name"><br>
        <input placeholder="email" name="email" type="email"><br>
        <input placeholder="password" name="password" type="password"><br>
        <input placeholder="confirm password" name="confirm" type="password"><br>
        <button>Log in</button>
    </form>
</main>
<?php include __DIR__ . '/includes/foot.php'; ?>
    
