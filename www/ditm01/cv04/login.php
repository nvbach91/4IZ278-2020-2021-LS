<?php
$invalidInputs = [];
$errors = [];
function makelogin($data)
{
    $databaseFileName = './database/users.db';
    $success = false;
    $message = '';
    $lines = file($databaseFileName);
    foreach ($lines as $line) {
        if (!$line) {
            continue;
        }
        $fields = explode(';', $line);
        $user = [
            'email' => $fields[1],
            'password' => preg_replace('/\s+/', '', $fields[2]),
        ];
        if ($user['email'] === $data['email']) {
            if ($user['password'] === $data['password']) {
                $success = true;
                $message = 'Login success';
            } else {
                $message = 'Wrong password';
            }
        } else {
            $message = 'User does not exist';
        }
    }
    $result = [
        'success' => $success,
        'message' => $message
    ];
    return $result;
}

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Please enter your email');
    }

    if (!$password) {
        array_push($invalidInputs, 'Please enter your password');
    }

    if (empty($invalidInputs)) {
        $loginResult = makelogin($_POST);
        if ($loginResult['success']) {
            header("Location: index.php?ref=login");
        } else {
            array_push($errors, $loginResult['message']);
        }
    }
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];
}

?>
<?php include './includes/header.php' ?>
<?php include './includes/navigation.php' ?>
<main>
    <?php foreach ($invalidInputs as $message) : ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php endforeach; ?>
    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endforeach; ?>
    <?php if (isset($_GET['email']) && @$_GET['ref'] === 'registration') : ?>
        <div class="alert alert-success">You have successfully signed up!</div>
    <?php endif; ?>
    <h1 class="title">Log in</h1>
    <form class="form-signup" method="POST">
        <div class="form-group">
            <label>Email</label>
            <input name="email" type="email" class="form-control" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input name="password" type="password" class="form-control">
        </div>
        </div>
        <div class="col text-center">
            <button class="btn btn-primary">Log in</button>
        </div>
    </form>
</main>
<?php include './includes/footer.php' ?>