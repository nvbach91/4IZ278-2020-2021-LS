<?php
$msg = '';
$msgClass = '';
function makeLogin($data)
{
    $databaseFileName = __DIR__ . '/database/user.db';

    $userRecords = file($databaseFileName);

    foreach ($userRecords as $userRecordLine) {
        $userRecord = substr($userRecordLine, 0, -1);
        if (!$userRecord) {
            return ['success2' => false, 'message' => 'User was not found.'];
        }
        $fields = explode(';', $userRecord);

        $user = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];
        if (($user['email'] === $data['email']) && ($user['password'] === $data['password'])) {
            return ['success2' => true];
        }
    }
    return ['success2' => false];
   
}



$errors = [];
$invalidInputs = [];
if (filter_has_var(INPUT_POST, 'submit')) {
    if (!empty($_POST)) {
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));

        if ((empty($email)) || (empty($password))) {
            array_push($invalidInputs, 'Please fill in all fields!');
            $msg = 'Please fill in all fields!';
            $msgClass = 'alert-danger';
        }

        if (empty($invalidInputs)) {
            // provedeme registraci
            $loginResult = makeLogin($_POST);

            if ($loginResult['success2']) {
                // send email
                //    sendEmail($email, 'Registration confirmation', 'Thank you for your registration');
                // redirect user to login page

                header("Location: users.php ");
            } else {
                array_push($errors);
                $msg = "Wrong name or password";
                $msgClass = 'alert-danger';
            }
        }
    }
}

?>


<?php include __DIR__ . '/includes/header.php' ?>
<?php include __DIR__ . '/includes/navigation.php' ?>

<div class="container">
    <h1>Login</h1>
    <?php if ($msg != '') : ?>
        <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
    <?php endif; ?>

    <?php foreach ($errors as $error) : ?>
        <p><?php echo $error; ?></p>
    <?php endforeach; ?>
    <form class="form-signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" name="email" placeholder="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''   ?>">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" name="password" placeholder="password" type="password" value="<?php echo isset($password) ? $password : ''; ?>">
        </div>
        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
    </form>
</div>

<?php include __DIR__ . '/includes/footer.php' ?>