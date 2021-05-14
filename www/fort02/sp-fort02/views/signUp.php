<?php require __DIR__ . '/../includes/head.php'; ?>
<?php require __DIR__ . '/../includes/nav.php'; ?>

<form>
    <h1>Registrovat se</h1>
    <h2>WIP</h2>
    <div class="row">
        <div class="col-12">
            <input type="text" id="firstName" name="firstName" placeholder="Jméno" autocomplete="off">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="text" id="lastName" name="lastName" placeholder="Příjmení">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="email" id="email" name="email" placeholder="E-mail">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="text" id="phone" name="phone" placeholder="Telefonní číslo">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="password" id="password" name="password" placeholder="Heslo">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Potvrďte heslo">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="submit" value="Registrovat se">
        </div>
    </div>          
</form>

<?php require __DIR__ . '/../includes/footer.php'; ?>