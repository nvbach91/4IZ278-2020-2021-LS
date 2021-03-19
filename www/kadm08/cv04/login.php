<?php include __DIR__ . '/lib/usersDb.php'; ?>
<?php 

$successMessages = [];
$errorMessages = [];

function authenticate($email, $password) {
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
    }
    else {
        array_push($errorMessages, $result['message']);
    }
}
?>
<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/includes/navigation.php'; ?>

<main>
    <h1>Login</h1>
    <?php foreach($successMessages as $message): ?>
        <p style="color:green;"><?php echo $message; ?></p>
    <?php endforeach; ?>
    <?php foreach($errorMessages as $message): ?>
        <p style="color:red;"><?php echo $message; ?></p>
    <?php endforeach; ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input name="email" type="email" value="<?php echo $defaultEmail ?>">
        <input name="password" type="password">
        <button>Log in</button>
    </form>
</main>
<?php include __DIR__ . '/includes/foot.php'; ?>