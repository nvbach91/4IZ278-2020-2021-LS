<?php include __DIR__ . '/../components/header.php'; ?>
<?php include __DIR__ . '/../components/navigation.php'; ?>

<div class="min-vh-100 position-relative page-container d-flex">

    <div class="m-auto text-center">

        <h1>Přihlášení</h1>

        <div class="mt-3 mb-2 px-0">
            <?php include __DIR__ . '/../components/errorPrinter.php'; ?>
            <form class="mt-3" method="post">
                <input name="email" type="text" class="form-control border-flat-bottom d-block" id="inputEmail" placeholder="Email">
                <input name="password" type="password" class="form-control border-flat-top d-block" id="inputPassword" placeholder="Password">
                <div class="my-2">
                    <button type="submit" class="btn btn-primary w-100">Přihlásit se</button>
                </div>
            </form>
            <a class="btn btn-google btn-outline-dark  mb-1" href="google"><i class="bi bi-google"></i> &nbsp;Přihlášení pomocí Google</a><br>
            <a href="register">Nemám uživatelský účet</a>
        </div>

    </div>

    <div class="position-absolute absolute-bottom w-100">
        <?php include __DIR__ . '/../components/footer.php'; ?>
    </div>

</div>
