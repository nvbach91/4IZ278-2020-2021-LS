<?php require __DIR__ . '/lib/users.php'; ?>


<?php

$successMessages = [];
$errorMessages = [];

function authenticate($email, $password)
{
    $user = fetchUser($email);
    if ($user == null) {
        return [
            'success' => false,
            'message' => "User not found!",
        ];
    }
    if ($password == $user['password']) {
        return [
            'success' => true,
            'message' => "Login successful",
        ];
    }
    return [
        'success' => false,
        'message' => "Wrong password",
    ];
}


if (array_key_exists("email", $_GET)) {
    array_push($successMessages, "Registration successful");
    $defaultEmail = htmlspecialchars($_GET["email"]);
} else if (array_key_exists("email", $_POST)) {
    $defaultEmail = htmlspecialchars($_POST["email"]);
} else {
    $defaultEmail = "";
}

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = authenticate($email, $password);
    if ($result['success'] == true) {
        array_push($successMessages, $result['message']);
    } else {
        array_push($errorMessages, $result['message']);
    }

    setcookie('email', $email, time() + 3600);
    header('Location: index.php');
}

?>
<?php include __DIR__ . '/includes/header.php'; ?>

<main class="container">
    <h1>Login</h1>
    <?php foreach ($successMessages as $message) : ?>
        <p style="color:green;"><?php echo $message; ?></p>
    <?php endforeach; ?>
    <?php foreach ($errorMessages as $message) : ?>
        <p style="color:red;"><?php echo $message; ?></p>
    <?php endforeach; ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Email</label>
        <input class="form-control" name="email" type="email" value="<?php echo $defaultEmail ?>">
        <label for="name">Password</label>
        <input class="form-control" name="password" type="password">
        <button type="submit" class="btn btn-primary">Log in</button>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>