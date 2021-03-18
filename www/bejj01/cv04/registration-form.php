<?php

require __DIR__ . '/utils/utils.php';

$alerts = [];
$alertStyle = 'bg-danger text-white';
$formSubmitted = !empty($_POST);

if ($formSubmitted) {
    $name = trim(@$_POST['name']);
    $email = trim(@$_POST['email']);
    $password = @$_POST['password'];
    $confPassword = @$_POST['confirm'];

    if (empty($name)) {
        $alerts['name'] = 'Please enter your name';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alerts['email'] = 'Please enter valid email address';
    }

    if ($password !== $confPassword) {
        $alerts['password'] = 'Passwords do not match each other!';
        $alerts['confPassword'] = 'Passwords do not match each other!';
    }
    else if (strlen($password) < 10) {
        $alerts['password'] = 'Password must have at least 10 characters!';
        $alerts['confPassword'] = 'Password must have at least 10 characters!';
    }
    

    if (empty($alerts)) {
        $registration = makeRegistration($_POST);

        if($registration['success']) {
            sendConfirmationMail($email, 'My Page: Successful registration', "Hello, Thank you for your registration on My Page.");
            header("Location: login-form.php?from=registration&email=$email");
        }
        else {
            $alerts['registration'] = [
                'message' => $registration['message'],
                'existingUser' => true
            ];
        }
        
    }
}

?>
<?php include './includes/header.php'?>
<main class="container col-md-5">
    <br>
    <h1 class="text-center">Registration</h1>
    <br>
    <div class="row justify-content-center">
        <?php if ($formSubmitted && !empty($alerts)): ?>
            <?php foreach($alerts as $alert): ?>
                <div class="alert <?php echo $alertStyle ?>">
                    <?php if(isset($alert['existingUser']) && $alert['existingUser']): ?>
                        <div class="text-center"><?php echo @$alert['message']?></div>
                        <div class="row justify-content-center">
                            <a href="./login-form.php" class="btn btn-info">Go to Login</a>
                        </div>
                    <?php else: ?>
                        <?php echo $alert?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="row justify-content-center">
        <form class="form-signup bg-dark" method="POST">
            <div class="form-group">
                <h5><label for="name">Name</label></h5>
                <input class="form-control <?php echo getInvalidClass('name', $alerts); ?>" id="name" name="name" placeholder="Enter your name" value="<?php echo isset($name) ? $name : '' ?>">
                <?php if(key_exists('name', $alerts)): ?>
                    <small class="text-white bg-danger">Valid example: Karel Novák</small>
                <?php endif ?>
            </div>
            <div class="form-group">
                <h5><label for="email">Email Address</label></h5>
                <input type="email" class="form-control <?php echo getInvalidClass('email', $alerts); ?>" id="email" placeholder="Enter your email address" name="email" value="<?php echo isset($email) ? $email : '' ?>">
                <?php if(key_exists('email', $alerts)): ?>
                    <small class="text-white bg-danger">Valid example: novak@gmail.com</small>
                <?php endif ?>
            </div>
            <div class="form-group">
                <h5><label for="password">Password</label></h5>
                <input type="password" class="form-control <?php echo getInvalidClass('password', $alerts); ?>" id="password" placeholder="Enter password" name="password" value="<?php echo isset($password) ? $password : '' ?>">
                <?php if(key_exists('password', $alerts)): ?>
                    <small class="text-white bg-danger">Valid example: aabb54iiKle</small>
                <?php endif ?>
            </div>
            <div class="form-group">
                <h5><label for="confPassword">Confirm Password</label></h5>
                <input type="password" class="form-control <?php echo getInvalidClass('confPassword', $alerts); ?>" id="confPassword" placeholder="Confirm password" name="confirm" value="<?php echo isset($confPassword) ? $confPassword : '' ?>">
                <?php if(key_exists('confPassword', $alerts)): ?>
                    <small class="text-white bg-danger">Valid example: aabb54iiKle</small>
                <?php endif ?>
            </div>
            <div class="divider"></div>
            <div class="row justify-content-center">
                <button class="btn btn-info" type="submit">Register</button>
            </div>
        </form>
    </div>
</main>
<?php include './includes/footer.php'?> 
