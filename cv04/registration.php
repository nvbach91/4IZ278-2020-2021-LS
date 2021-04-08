<?php include __DIR__ . '/incl/header.php'; ?>
<?php

require __DIR__ . '/utils/utils.php';

$invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-danger';
$errors = [];

// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm = htmlspecialchars(trim($_POST['confirm']));


    if (!$name) {
        array_push($alertMessages, 'Please enter your name');
        array_push($invalidInputs, 'name');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($alertMessages, 'Please use a valid email');
        array_push($invalidInputs, 'email');
    }

    if ($password !== $confirm || strlen($password) < 8 || strlen($confirm) < 8) {
        $errors['password'] = 'Please use a valid password';
        $errors['confirm'] = 'Please use a valid password';
    }

    if (!count($alertMessages)) {
        $alertType = 'alert-success';
        $alertMessages = ['Woohoo! You have successfully signed up!'];
    }
}
?>
<main class="main">
    <br>
    <h1>Form validation example</h1>
    <h3>Registration form</h3>
    <div class="row justify-content-center">
        <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php if ($submittedForm) : ?>
                <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label>Name*</label>
                <input class="form-control<?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>" name="name" value="<?php echo isset($name) ? $name : '' ?>">
                <small class="text-muted">You need to fill your full name</small>
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input class="form-control<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" name="email" value="<?php echo isset($name) ? $email : '' ?>">
                <small class="text-muted">example@example.com</small>
            </div>
            <div class="form-group">
                <label>Password* (Please use at least 10 characters)</label>
                <input class="form-control<?php echo getInputValidClass('password', $errors); ?>" name="password" value="<?php echo @$password; ?>" type="password">

                <label>Confirm password*</label>
                <input class="form-control<?php echo getInputValidClass('confirm', $errors); ?>" name="confirm" value="<?php echo @$confirm; ?>" type="password">
                <small class="text-muted">Example: <?php echo generateRandomPassword(10); ?></small>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
    </div>
    </form>
</main>

<?php include __DIR__ . "/incl/footer.php"; ?>