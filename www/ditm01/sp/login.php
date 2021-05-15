<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>
<main class="container-sm">
    <div class=" mb-2 text-center">
        <h2>Log in</h2>
    </div>
    <form class="row g-3 form-login">
        <div class="col-md-12">
            <label for="inputEmailLogin" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="inputEmailLogin">
        </div>
        <div class="col-md-12">
            <label for="inputPasswordLogin" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="inputPasswordLogin">
        </div>
        <div class="col-md-12 text-left">
           <p>Don't have an account yet?  <a href="registration.php">Register now</a></p>
        </div>
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Log in</button>
        </div>
    </form>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>