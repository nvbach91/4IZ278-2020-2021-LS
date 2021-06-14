<?php

session_start();
require_once __DIR__ . '/config/config.php';

include __DIR__ . '/_utils/functions.php';
include __DIR__ . '/partials/header.php';
include __DIR__ . '/navigation.php';
$alertType = 'alert-danger';
$invalidInputs = [];
$alertMessages = [];
 
$submittedForm = !empty($_POST);
if ($submittedForm) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con_password = $_POST['con_password'];

    $exists = $connect->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');

    $exists->execute([
      'email' => $email
    ]);

    $existing_user = @$exists->fetchAll()[0];

    if ($existing_user) {
        array_push($alertMessages, "Email already used");
    } 
    else if (strlen($password) < 4) {
        array_push($alertMessages, "Choose longer password");
    }
    else if ($password !== $con_password){

        array_push($alertMessages, "Please enter same passwords");
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //vlozime usera do databaze
    $stmt = $connect->prepare('INSERT INTO users(email, password) VALUES (:email, :password)');
    $stmt->execute([
        'email' => $email, 
        'password' => $hashedPassword
    ]);

    $stmt = $connect->prepare('SELECT user_id FROM users WHERE email = :email LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    $stmt->execute([
        'email' => $email
    ]);
    $user_id = (int) $stmt->fetchColumn();

    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_email'] = $email;

    sendEmail($email, 'My Awesome App: Registration was a success', "Hello, thank you for your registration, ...");

    header('Location: index.php');
    }
    
}
?>

<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-6">
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
                    <label for="exampleInputPassword1" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control<?php echo in_array('password', $invalidInputs) ? ' is-invalid' : '' ?>" value="<?php echo isset($password) ? $password : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Confirm Password:</label>
                    <input type="password" name="con_password" class="form-control<?php echo in_array('con_password', $invalidInputs) ? ' is-invalid' : '' ?>" value="<?php echo isset($con_password) ? $con_password : '' ?>">
                </div>
                <button class="btn btn-info">Sign up</button>
            </form>
        </div>
    </div>
</div>