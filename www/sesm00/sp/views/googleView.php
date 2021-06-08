<?php include __DIR__ . '/../components/header.php'; ?>
<?php include __DIR__ . '/../components/navigation.php'; ?>

<div class="min-vh-100 position-relative page-container">
    <div class="container py-2">

        <h1>Registrace</h1>
        <h4>Potřebujeme ještě váš telefon</h4>

        <div class="col-4 mt-3 px-0">
            <?php include __DIR__ . '/../components/errorPrinter.php'; ?>
            <form class="row mt-3" method="post">
                <div class="col-auto">
                    <input name="phone" type="text" class="form-control" id="inputPhone" placeholder="Telefon" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ""; ?>">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Registrovat</button>
                </div>
            </form>
            <a href="login">Zpět na přihlášení</a>
        </div>

    </div>

    <div class="position-absolute absolute-bottom w-100">
        <?php include __DIR__ . '/../components/footer.php'; ?>
    </div>
</div>
