<?php include __DIR__ . '/../components/header.php'; ?>
<?php include __DIR__ . '/../components/navigation.php'; ?>

<div class="container py-5">

    <h1>Přihlášení</h1>

    <div class="col-4 mt-3 px-0">
        <?php foreach ($this->errors as $error): ?>
            <div role="alert" class="alert alert-danger"><?php echo $error; ?></div>
        <?php endforeach; ?>
        <form class="row mt-3" method="post">
            <div class="col-auto">
                <input name="email" type="text" class="form-control border-flat-bottom" id="inputEmail" placeholder="Email">
            </div>
            <div class="col-auto">
                <input name="password" type="password" class="form-control border-flat-top" id="inputPassword" placeholder="Password">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Přihlásit se</button>
            </div>
        </form>
        <a href="register.php">Nemám uživatelský účet</a>
    </div>

</div>
<div style="margin-bottom: 600px"></div>

<?php include __DIR__ . '/../components/footer.php'; ?>
