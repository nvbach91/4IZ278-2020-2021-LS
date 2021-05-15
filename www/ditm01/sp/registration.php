<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>
<main class="container-sm">
    <div class=" mb-2 text-center">
        <h2>Registration</h2>
    </div>
    <form class="row g-3 form-registration">
        <div class="col-md-12">
            <label for="inputEmailRegister" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="inputEmailRegister" placeholder="email@example.com">
        </div>
        <div class="col-md-12">
            <label for="inputPasswordRegister" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="inputPasswordRegister">
        </div>
        <div class="col-md-12">
            <label for="inputPasswordRegisterConfirm" class="form-label">Confirm password</label>
            <input name="password" type="password" class="form-control" id="inputPasswordRegisterConfirm">
            <span class="text-muted">Minimum length is 8 characters</span>
        </div>
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>