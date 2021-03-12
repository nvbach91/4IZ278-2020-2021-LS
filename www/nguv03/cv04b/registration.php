<?php 

function sendEmail($recipient, $subject, $message) {
    $header = [
        'MIME-Version: 1.0',
        'Content-type: text/html, charset=utf-8',
        'From: app@dev.com',
        'Reply-To: app@dev.com',
        'X-Mailer: PHP/8.0',
    ];
    $body = "
        <h1>$subject</h1>
        <p>$message</p>
    ";
    $mailResult = mail($recipient, $subject, $body, $header);
    return $mailResult;
}

function makeRegistration($data) {

    $databaseFileName = __DIR__ . '/database/users.db';

    $userRecords = file($databaseFileName);
    /*[
        'VIET BACH NGUYEN;nvbach91@gmail.com;1234',
        'Viet Bach Nguyen;nvbach91@gmail.com;3214',
        'Viet Bach Nguyen;nvbach91@gmail.com;3214',
        'Viet Bach Nguyen;nvbach91@gmail.com;3214',
        'Viet Bach Nguyen;nvbach91@gmail.com;3214',
        '',
    ]*/
    $isExistingUser = false;
    foreach($userRecords as $userRecord) {
        if (!$userRecord) {
            continue;
        }
        $fields = explode(';', $userRecord);
        // [ 'VIET BACH NGUYEN', 'nvbach91@gmail.com', '1234' ]
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
        return [ 'success' => false, 'message' => 'User already exists' ];
    }


    $userInformation = [
        $data['name'],
        $data['email'],
        $data['password'],
    ];
    
    $record = implode(';', $userInformation) . "\r\n";
    file_put_contents($databaseFileName, $record, FILE_APPEND);
    return [ 'success' => true, 'message' => 'Success' ];
};

$invalidInputs = [];
$errors = [];

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    // validace
    if ($password !== $confirm) {
        array_push($invalidInputs, 'Passwords do not match');
    }

    if (empty($invalidInputs)) {
        // provest registraci
        $registrationResult = makeRegistration($_POST);
        
        // [ 'success' => false, 'message' => 'User already exists' ];
        // [ 'success' => true, 'message' => 'Success' ];
        if ($registrationResult['success']) {
            // send email
            sendEmail($email, 'Registraion confirmation', 'Thank you for you registration');
            // redirect user to login page
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
    <?php // /4IZ278-2020-2021-LS/www/nguv03/cv04b/registration.php ?>
        <input placeholder="name" name="name">
        <br>
        <input placeholder="email" name="email" type="email">
        <br>
        <input placeholder="password" name="password" type="password">
        <br>
        <input placeholder="confirm" name="confirm" type="password">
        <br>
        <button>Submit</button>
    </form>
</main>
<?php include __DIR__ . '/includes/foot.php'; ?>
