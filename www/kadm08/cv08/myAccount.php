<?php
if (!isset($_COOKIE['email'])) {
   header('Location: login.php');
   exit();
}
$email = @$_COOKIE['email'];

?>

<?php require __DIR__ . '/includes/header.php'; ?>

<main class="container">
    <h1>About me</h1>
    <form method="POST">
        <div class="form-group">
            <label for="name">Email</label>
            <input class="form-control" id="name" placeholder="Name" value="<?php echo $email; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Log in</button> or <a href="./">Go back to Homepage</a>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>