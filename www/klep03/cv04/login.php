<?php include __DIR__ . '/includes/fetchUsers.php' ?>
<?php include __DIR__ . '/includes/fetchUser.php' ?>

<?php include __DIR__ . '/includes/head.php' ?>

<?php include __DIR__ . '/includes/navigation.php'; ?>

<?php
$email = null;
if (!empty($_GET['email'])) {
    $email = $_GET['email'];
}
?>

<?php
$errors = [];
$messages = [];
if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = fetchUser($email);

    /** User doesn't exist */
    if ($user === null) {
        array_push($errors, 'Uživatel neexistuje. ');
    } else {
        /** Password is incorrect */
        $userPassword = $user['password'];
        if (trim($userPassword) !== trim($password)) {
            array_push($errors, "Špatné heslo. ");
        }
    }

    if (empty($errors)) {
        array_push($messages, 'Přihlášení bylo úspěšné!');
    }
}
?>

<main>
    <h1>Login</h1>
    <?php foreach ($errors as $error) : ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endforeach; ?>
    <?php foreach ($messages as $message) : ?>
        <p class="success"><?php echo $message; ?></p>
    <?php endforeach; ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        ?>
        <input placeholder="email" name="email" type="email" value="<?php echo $email; ?>">
        <br>
        <input placeholder="password" name="password" type="password">
        <br>
        <button>Login</button>
    </form>
</main>

<?php include __DIR__ . '/includes/foot.php' ?>