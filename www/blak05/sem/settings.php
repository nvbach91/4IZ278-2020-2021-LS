<?php
    session_start();
    $_SESSION["location"] = "account";
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<?php 
    require __DIR__ . '/db/usersDB.php'; 

    if (!empty($_SESSION["user"])) {
        $mail = $_SESSION["user"];
        $usersDB = new UsersDB();
        $user = $usersDB->fetch($mail);

        if(!empty($_POST)){
            $email = $_SESSION["user"];
            $name = htmlspecialchars($_POST['inputUsername']);
            $address = htmlspecialchars($_POST['inputAddress']);
            $city = htmlspecialchars($_POST['inputCity']);
            $psc = htmlspecialchars($_POST['inputPsc']);
            $letter = 0;
            if (isset($_POST['inputLetter'])) {
            $letter = 1;
            }
            $updateDB = new UsersDB();
            $update = $updateDB->update([$name, $address, $city, $psc, $letter, $email]);
            Header("Location: settings.php");
        }
    }else{
        Header("Location: index.php");
    }

?>
<main>
<div class="text-center" style="width: 70%; margin: 0 auto; padding-top: 50px;">
    <form class="row g-3 form-signin" action="#" method="POST">
        <h1 class="h3 pt-5 font-weight-normal">Nastavení</h1>
        <p>- editujte své údaje -</p>
        <div class="col-12">
            <label for="inputUsername" class="form-label">Celé jméno</label>
            <input type="text" class="form-control" name="inputUsername" value="<?php echo $user["name"]?>">
        </div>
        <div class="col-md-6">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" name="inputEmail" placeholder="Email měnit nejde" disabled>
        </div>
        <div class="col-md-6">
            <label for="inputPassword" class="form-label">Heslo</label>
            <input type="password" class="form-control" name="inputPassword" placeholder="Heslo měnit nejde" disabled>
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Vaše Adresa</label>
            <input type="text" class="form-control" name="inputAddress" value="<?php echo $user["address"]?>">
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">Město</label>
            <input type="text" class="form-control" name="inputCity" value="<?php echo $user["city"]?>">
        </div>
        <div class="col-md-6">
            <label for="inputPsc" class="form-label">PSČ</label>
            <input type="text" class="form-control" name="inputPsc" value="<?php echo $user["psc"]?>" inputmode="numeric" pattern="[0-9]{5}">
        </div>
        <div class="col-auto offset-sm-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="inputLetter" <?php echo $user["newsletter"]===1 ? "checked" : ""?> >
                <label class="form-check-label" for="gridCheck">
                    Mám zájem o newsletter!
                </label>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-lg btn-outline-dark btn-warning btn-block" type="submit">Uložit!</button>
        </div>
    </form>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>