<?php 

require './utils.php';

$invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-danger';
$regexName = '~^(?:[\p{L}\p{Mn}\p{Pd}\'\x{2019}]+\s[\p{L}\p{Mn}\p{Pd}\'\x{2019}]+\s?)+$~u';
$regexMail = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
$regexPassword = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';  

function makeRegistration($data)
{

    $databaseFileName =  './database/users.db';

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


// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars($_POST['password']);
    $confirm = htmlspecialchars($_POST['confirm']);

    // check name, regex allows unicode letters (abcd), accents (ěáí), hyphens(Anna-Marie), single quotes (Charlie O' Hara)
    if (!preg_match($regexName, $name)) {
        array_push($alertMessages, 'Please enter your name');
        array_push($invalidInputs, 'name');
    }

    // check email, according to php docs validate email filter uses RFC 822 which is obsolete, lets use RFC 5322, internationalized mails wont work (e.g. 用户@例子.广告)
    if (!preg_match($regexMail, $email)) {
        array_push($alertMessages, 'Please use a valid email');
        array_push($invalidInputs, 'email');
    }

    // check password min 8 chars, at least 1 number and 1 letter  
    if (!preg_match($regexPassword, $password)) {
        array_push($alertMessages, 'Please use a valid password');
        array_push($invalidInputs, 'password');
    }

    // check passwords match 
    if ($password !== $confirm) {
        array_push($alertMessages, 'Passwords dont match');
        array_push($invalidInputs, 'confirm');
    }

    if (!count($alertMessages)) {
        $registrationResult = makeRegistration($_POST);
        if ($registrationResult['success']) {
            sendEmail($email, 'Registration successful', 'Very good.');
            header('Location: login.php?ref=registration&email=' . $email);
        } else {
            array_push($alertMessages, $registrationResult['message']);
        }
    }
}

?>

<?php include './includes/header.php' ?>
<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
    <div class="inner">
        <h3 class="masthead-brand">Form</h3>
        <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link" href=".">Home</a>
        <a class="nav-link active" href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
        <a class="nav-link" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
        </nav>
    </div>
    </header>
    <main role="main" class="inner cover">
        <h1 class="text-center">Registration</h1>
        <form class="form-signup" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php if ($submittedForm && !empty($alertMessages)): ?>
        <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
        <?php endif; ?>
            <div class="form-group">
                <label>Name*</label>
                <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
                <small class="text-muted">Example: Johnny Depp</small>
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
                <small class="text-muted">Example: example@google.com</small>
            </div>
            <div class="form-group">
                <label>Password*</label>
                <input class="form-control" type="password" name="password" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Confirm password*</label>
                <input class="form-control" type="password" name="confirm" autocomplete="off">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </main>
</div>
<?php include './includes/footer.php' ?>