<?php require __DIR__ . '/includes/header.php'; ?>
<?php require __DIR__ . '/includes/navigation.php'; ?>
<?php

?>

<div class="container-fluid" id="login-area">
    <div class="col-md-3">
        <form>
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="login" class="form-control" id="login">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Log In</button>
        </form>
    </div>
    <br>
    <div>
        <label class="form-label">New around here?</label>
        <a href="registration.php" type="button" class="btn btn-primary">Register</a>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php' ?> 