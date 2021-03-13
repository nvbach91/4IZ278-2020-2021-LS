<?php

require __DIR__ . '/utils/utils.php';

$invalidInputs = [];
$errors = [];
$isSubmitted = !empty($_POST);

function makeRegistration($data)
{

    $databaseFileName =  __DIR__ . '/database/users.db';

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

        $newRecord = implode(';', $userInformation) . "\r\n";

        file_put_contents($databaseFileName, $newRecord, FILE_APPEND);
        $success = true;
    }

    $result = [
        'success' => $success,
        'message' => $message,
    ];

    return $result;
}

if ($isSubmitted) {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirm']);

    if (!preg_match('/^(?:\b[A-Ž]+\b[\s\r\n]*){2,4}$/', $name)) {
        if (!$name) {
            array_push($invalidInputs, 'Please, fill the name in');
        } else {
            array_push($invalidInputs, 'Name is not valid');
        }
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (!$email) {
            array_push($invalidInputs, 'Please, fill the email in');
        } else {
            array_push($invalidInputs, 'Email is not valid');
        }
    }
    if (!$password) {
        array_push($invalidInputs, 'Please, fill the password in');
    }
    if (!$confirmPassword) {
        array_push($invalidInputs, 'Please, confirm the password');
    }
    if ($password !== $confirmPassword) {
        array_push($invalidInputs, 'Passwords do not match');
    }

    if (empty($invalidInputs)) {
        //provest registraci
        $registrationResult = makeRegistration($_POST);
        if ($registrationResult['success']) {
            //email o usepsne registraci
            sendEmail($email, 'My Awesome App: Registration was a success', "Hello, thank you for your registration. You can log in at http://localhost/4IZ278/www/vetj00/cv04/login.php");
            //presmerovat na login
            header("Location: login.php?email=$email");
        } else {
            array_push($errors, $registrationResult['message']);
        }
    }
}

?>


<?php include __DIR__ . '/includes/header.php'; ?>
<main>
    <?php include __DIR__ . '/includes/navigation.php'; ?>
    <h1>Registration</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <?php foreach ($invalidInputs as $message) : ?>
            <p><?php echo $message; ?></p>
        <?php endforeach; ?>
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
        <div>
            <label>Name*</label>
            <input name="name" value="<?php echo isset($name) ? $name : '' ?>">
        </div>
        <div>
            <label>Email*</label>
            <input name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div>
            <label>Password*</label>
            <input name="password" type="password">
        </div>
        <div>
            <label>Confirm password*</label>
            <input name="confirm" type="password">
        </div>
        <button type="submit">Submit</button>
    </form>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>