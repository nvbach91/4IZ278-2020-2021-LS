<?php

function sendEmail($recipient, $subject, $message)
{
    $header = 
    [
        'MIME-VERSION: 1.0',
        'Content-type: text/html, charset=utf-8',
        'From: app@dev.com',
        'Reply-To: app@dev.com',
        'X-Mailer: PHP/8.0'
    ];

    $body = "
    <h1>$subject</h1>
    <p>$message<p>
    ";

    $mailResult = mail($recipient,$subject,$body,implode("\r\n", $header));
    return $mailResult;
}

function makeRegistration($data)
{
    $databaseFileName = __DIR__ . '/database/users.db';

    $userRecords = file($databaseFileName);

    $isExistingUser = false;

    foreach($userRecords as $userRecord)
    {
        if (!$userRecord)
        {
            continue;
        }
        $fields = explode(';',$userRecord);
        $user = 
        [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];

        if($user['email']===$data['email'])
        {
            $isExistingUser = true;
            break;
        }
    }

    if($isExistingUser)
    {
        return [ 'success' => false, 'message' => 'User already exists'];
    }

    $userInformation = 
    [
    $name = $data['name'],
    $email = $data['email'],
    $password = $data['password'],
    ];

    $record = implode(';', $userInformation) . "\r\n";

    file_put_contents($databaseFileName, $record, FILE_APPEND);

    return [ 'success' => true, 'message' => 'Success'];
};

$invalidInputs = [];
$errors = [];

if (!empty($_POST))
{
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm = htmlspecialchars(trim($_POST['confirm']));

    if (!$email) {
        array_push($invalidInputs, 'Email is empty');
    }

    if (!$name) {
        array_push($invalidInputs, 'Name is empty');
    }

    if (!$password) {
        array_push($invalidInputs, 'Password is empty');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Email is in invalid format');
    }

    if($password !== $confirm)
    {
        array_push($invalidInputs, 'Passwords do not match');
    }
    if(empty($invalidInputs))
    {
        $registrationResult = makeRegistration($_POST);

        if($registrationResult['success'])
        {
            sendEmail($email,"Registration confirmation","Thank you for your registration");
            header("Location: login.php?email=$email"); //redirect

        } else {array_push($errors, $registrationResult['message']);}
    }
    
}

?>


<?php include './includes/head.php'; ?>
<nav>
    <a href="./index.php">Homepage</a>
    <a href="./registration.php">Registration</a>
    <a href="./login.php">Login</a>
</nav>

<main>
<h1>Registration</h1>
<?php foreach($invalidInputs as $message): ?>
<p><?php echo $message;?></p>
<?php endforeach; ?>
<?php foreach($errors as $message): ?>
<p><?php echo $message;?></p>
<?php endforeach; ?>
<form method = "POST" action = "<?php echo $_SERVER['PHP_SELF'];?>">
    <input placeholder = "name" value="<?php echo isset($name) ? $name : '' ?>" name = "name">
    <br>
    <input placeholder = "email" value="<?php echo isset($email) ? $email : '' ?>" name = "email" type = "email">
    <br>
    <input placeholder = "password" value="<?php echo isset($password) ? $password : '' ?>" name = "password" type = "password">
    <br>
    <input placeholder = "confirm" value="<?php echo isset($confirm) ? $confirm : '' ?>" name = "confirm" type = "password">
    <br>
    <button>Submit</button>
</form>
</main>
<?php include './includes/foot.php'; ?>