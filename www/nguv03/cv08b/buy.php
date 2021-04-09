<?php 
if (!empty($_POST)) {
    $username = $_POST['username'];

    // check login data!
    // check user password

    setcookie('username', $username, time() + 3600);
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <?php if (@$_COOKIE['username']): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Go to login</a>
        <?php endif; ?>
    </nav>
    <h1>Login</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label>Username</label>
        <input name="username" placeholder="your username">
        <button>Login</button>
    </form>
</body>
</html>