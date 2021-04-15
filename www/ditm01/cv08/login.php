<?php

$name = @$_POST['name'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    setcookie("name", $_POST['name'], time() + 3600);
    header('Location: index.php');
    exit();
}
?>

<?php include __DIR__ . '/includes/header.php' ?>
<form class="form-signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="mb-3">
        <label for="user" class="form-label">Username</label>
        <input name="name" type="" class="form-control" id="user">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

<?php include __DIR__ . '/includes/footer.php' ?>