<?php require __DIR__ . '/../includes/head.php'; ?>
<?php require __DIR__ . '/../includes/nav.php'; ?>

<form>
    <h1>Přihlásit se</h1>
    <h2>WIP</h2>
    <div class="row">
        <div class="col-12">
            <input type="email" id="email" name="email" placeholder="E-mail">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="password" id="password" name="password" placeholder="Heslo">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="submit" value="Přihlásit se">
        </div>
    </div>          
</form>

<div>
    <a href="../views/signUp.php">Registrovat se</a>
</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>