<?php
$isSubmitted = !empty($_POST);
$invalidInputs = [];

if ($isSubmitted) {
    $name = htmlspecialchars(trim($_POST['username']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (!$name) {
        array_push($invalidInputs, 'Username is empty');
    }
    if (!$phone) {
        array_push($invalidInputs, 'Phone is empty');
    }
    if (!preg_match('/^\+?([0-9]{3} ?){4}$/', $phone)) {
        array_push($invalidInputs, 'Phone number is not a valid format');
    }
    if (!$email) {
        array_push($invalidInputs, 'Email is empty');
    }
    if (!$password) {
        array_push($invalidInputs, 'Password is empty');
    }
    if (!preg_match('/^[a-zA-Z0-9]{8,}$/', $password)) {
        array_push($invalidInputs, 'Password is too short');
    }

    $alert = 'alert-success';
    $success = "<h2>Form is submitted👍</h2>";
    $fail = '<h2>😔</h2>';
    # $alertMessages = $invalidInputs ? $fail . implode('<br>', $invalidInputs) : $success;
    if ($invalidInputs) {
        $alert = 'alert-danger';
        $alertMessages = $fail . implode('<br>', $invalidInputs);
    } else {
        $alertMessages = $success;
    }
}
?>

<?php include __DIR__ . '/includes/header.php' ?>

<main>
    <h1>Form submission</h1>
    <?php if ($isSubmitted) : ?>
        <div class="alert <?php echo $alert ?>" role="alert">
            <?php echo $alertMessages ?>
        </div>
    <?php endif; ?>
    <form class="form-signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="mb-3">
            <label for="user" class="form-label">Username</label>
            <input name="username" type="" class="form-control" id="user">
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input name="phone" type="" class="form-control" id="phone">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input name="email" type="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>
<?php include __DIR__ . '/includes/footer.php' ?>