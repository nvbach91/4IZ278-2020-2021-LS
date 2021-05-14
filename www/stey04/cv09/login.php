<?php
require "config.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->execute(['email' => $email]);
    $existing_user = @$stmt->fetchAll()[0];
    var_dump($existing_user);
    if (password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = $existing_user['id'];
        $_SESSION['user_email'] = $existing_user['email'];

        header('Location: index.php');
    } else {
        exit('Invalid user or password!');
    }
}
?>

<?php include __DIR__ . '/includes/header.php' ?>
<?php include __DIR__ . '/includes/nav.php' ?>
<form class="form-signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="mb-3">
        <label for="user" class="form-label">email</label>
        <input name="email" type="" class="form-control" id="user">
    </div>
    <div class="mb-3">
        <label for="user" class="form-label">password</label>
        <input name="password" type="" class="form-control" id="user">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

<?php include __DIR__ . '/includes/footer.php' ?>