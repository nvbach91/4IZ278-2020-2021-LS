<?php

$invalidInputs = [];
$loginSuccessful = false;
if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));


    $databaseFileName = __DIR__ . '/database/users.db';

    $userRecords = file($databaseFileName);

    $isExistingUser = false;

    $storedPassword;

    foreach ($userRecords as $userRecord) {
        if (!$userRecord) {
            continue;
        }
        $fields = explode(';', $userRecord);
        $user =
            [
                'name' => $fields[0],
                'email' => $fields[1],
                'password' => $fields[2],
            ];

        if ($user['email'] === $_POST['email']) {
            $isExistingUser = true;
            $storedPassword = trim($user['password']);
            break;
        }
    }

    if (!$isExistingUser) {
        array_push($invalidInputs, 'User does not exist');
    }

    if ($password !== $storedPassword) {
        array_push($invalidInputs, 'Password is incorrect');
    }

    if (empty($invalidInputs)) {
        $loginSuccessful = true;
    }
}

?>

<?php include './includes/head.php'; ?>
<nav>
    <a href="./index.php">Homepage</a>
    <a href="./registration.php">Registration</a>
    <a href="./login.php">Login</a>
    <?php
    if ($loginSuccessful) {
        echo '<a href="./admin/users.php">Users</a>';
    }
    ?>
</nav>

<main>
    <h1>Login</h1>
    <?php foreach ($invalidInputs as $message) : ?>
        <p><?php echo $message; ?></p>
    <?php endforeach; ?>

    <?php
    if ($loginSuccessful) {
        echo "Login successful";
    }
    ?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input placeholder="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : '' ?>" name="email" type="email">
        <br>
        <input placeholder="password" name="password" type="password">
        <br>
        <button>Submit</button>
    </form>
</main>
<?php include './includes/foot.php'; ?>