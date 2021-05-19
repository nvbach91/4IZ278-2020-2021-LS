<?php require __DIR__ . '/../includes/head.php'; ?>
<?php require __DIR__ . '/../includes/nav.php'; ?>

<form>
    <h1>Registrovat se</h1>
    <div class="row">
        <div class="col-12">
            <input type="text" id="name" name="email" placeholder="Jméno" autocomplete="off">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="email" id="email" name="email" placeholder="Email">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="text" id="phone" name="phone" placeholder="Telefonní číslo">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="text" id="regNumber" name="regNumber" placeholder="IČO">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="password" id="password" name="password" placeholder="Heslo">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Heslo znovu">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="submit" value="Registrovat se">
        </div>
    </div>          
</form>

<?php require __DIR__ . '/../includes/footer.php'; ?> 