<?php include __DIR__ . '/../components/header.php'; ?>
<?php include __DIR__ . '/../components/navigation.php'; ?>

<div class="min-vh-100 position-relative page-container d-flex">
    <div class="m-auto text-center">

        <h1>Registrace</h1>

        <div class="mt-3 mb-2 px-0">
            <?php include __DIR__ . '/../components/errorPrinter.php'; ?>
            <?php if ($this->success) : ?>
                <div role="alert" class="alert alert-success">Registrace úspěšná</div>
            <?php endif; ?>
            <form class="mt-3" method="post">
                <input name="firstname" type="text" class="form-control border-flat-bottom d-block" id="inputFirstname" placeholder="Jméno" value="<?php echo isset($_POST['firstname']) && !$this->success ? $_POST['firstname'] : ""; ?>">
                <input name="lastname" type="text" class="form-control border-flat-top border-flat-bottom d-block" id="inputLast" placeholder="Příjmení" value="<?php echo isset($_POST['lastname']) && !$this->success ? $_POST['lastname'] : ""; ?>">
                <input name="email" type="text" class="form-control border-flat-top border-flat-bottom d-block" id="inputEmail" placeholder="Email" value="<?php echo isset($_POST['email']) && !$this->success ? $_POST['email'] : ""; ?>">
                <input name="password" type="password" class="form-control border-flat-top border-flat-bottom d-block" id="inputPassword" placeholder="Heslo">
                <input name="passwordConfirm" type="password" class="form-control border-flat-top border-flat-bottom d-block" id="inputPasswordConfirm" placeholder="Potvrzení hesla">
                <input name="phone" type="text" class="form-control border-flat-top d-block" id="inputPhone" placeholder="Telefon" value="<?php echo isset($_POST['phone']) && !$this->success ? $_POST['phone'] : ""; ?>">
                <div class="my-2">
                    <button type="submit" class="btn btn-primary w-100">Registrovat</button>
                </div>
            </form>
            <a class="btn btn-google btn-outline-dark  mb-1" href="google"><i class="bi bi-google"></i> &nbsp;Registrace pomocí Google</a><br>
            <a href="login">Zpět na přihlášení</a>
        </div>

    </div>

    <div class="position-absolute absolute-bottom w-100">
        <?php include __DIR__ . '/../components/footer.php'; ?>
    </div>
</div>
