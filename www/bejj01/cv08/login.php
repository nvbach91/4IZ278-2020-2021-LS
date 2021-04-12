<?php
require __DIR__ . '/includes/header.php'; 

$username = @$_POST['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    setcookie('username', $username, time() + 3600);
    header('Location: index.php');
}

?>

<main class="container">
    <h1 class="text-center">Login</h1>
    <form class="login-form" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" placeholder="Enter your username" name="username" id="username">
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-dark" type="submit">Log In</button>
        </div>
    </form>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>