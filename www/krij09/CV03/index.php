<?php
$alerts = [];
$form = !empty($_POST);
$gender = "none";
$regex = "/\+([0-9]{3}\s)([0-9]{3}\s)([0-9]{3}\s)([0-9]{3})$/";

if($form)
{
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $gender = htmlspecialchars($_POST['gender']);
    $phone = htmlspecialchars($_POST['phone']);
    $avatarUrl = htmlspecialchars($_POST['avatar']);
    $deck = htmlspecialchars($_POST['deck']);
    $cardsInDeck = htmlspecialchars($_POST['cardsInDeck']);

    if($name == "")
        array_push($alerts, array("Zadejte uživatelské jméno","alert-danger"));

    if($email == "")
        array_push($alerts, array("Zadejte email","alert-danger"));
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($alerts, array("Email je ve špatným formátu","alert-warning"));

    if($gender == "none")
        array_push($alerts,array("Prosím zadejte vaše pohlaví", "alert-danger"));

    if($phone == "")
        array_push($alerts, array("Tel. číslo nesmí být prázdné","alert-danger"));
    else if(!preg_match($regex, $phone))
        array_push($alerts, array("Tel. číslo musí být ve správným formátu (např.: +420 123 456 789)", "alert-warning"));

    if($avatarUrl == "")
        array_push($alerts, array("Vložte URL vašeho avatara","alert-danger"));
    else if(!filter_var($avatarUrl, FILTER_VALIDATE_URL))
        array_push($alerts,array("Nesprávná URL avatara","alert-warning"));

    if($deck == "")
        array_push($alerts, array("Zadejte název vašeho balíčku","alert-danger"));

    if($cardsInDeck == "")
        array_push($alerts, array("Počet karet v balíčku nesmí být prázdný","alert-danger"));
    else if(!filter_var($cardsInDeck, FILTER_VALIDATE_INT))
        array_push($alerts,array("Počet karet v balíčku musí být číslo","alert-warning"));
    else if (filter_var($cardsInDeck, FILTER_VALIDATE_INT))
        if($cardsInDeck < 0)
            array_push($alerts, array("Počet karet v baličku nesmí být záporný","alert-warning"));



    if(empty($alerts))
        array_push($alerts,array("<img src=\"$avatarUrl\" class=\"avatar\">Úspěšně ses zaregistroval","alert-success"));

}

?>

<?php include "./utils/header.php"; ?>
<div class="container">
    <form class="form-signup" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <?php if($form): foreach ($alerts as $alert):?>
        <div class="alert <?php echo $alert[1]; ?>"><?php echo $alert[0]; ?></div>
        <?php endforeach; endif; ?>
        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name : "" ?>">
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : "" ?>">
        </div>
        <div class="form-group">
            <label>Gender*</label>
            <select name="gender" class="form-control">
                <option value="none" <?php echo $gender == "none" ? "selected" : "" ?>></option>
                <option value="man" <?php echo $gender == "man" ? "selected" : "" ?>>Muž</option>
                <option value="woman" <?php echo $gender == "woman" ? "selected" : "" ?>>Žena</option>
                <option value="other" <?php echo $gender == "other" ? "selected" : "" ?>>Jiné</option>
            </select>
        </div>
        <div class="form-group">
            <label>Phone*</label><small class="text-muted"> Example: +420 123 456 789</small>
            <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : "" ?>">

        </div>
        <div class="form-group">
            <label>Avatar URL*</label>
            <input class="form-control" name="avatar" value="<?php echo isset($avatarUrl) ? $avatarUrl : "" ?>">
        </div>
        <div class="form-group">
            <label>Deck name*</label>
            <input class="form-control" name="deck" value="<?php echo isset($deck) ? $deck : "" ?>">
        </div>
        <div class="form-group">
            <label>Cards in deck*</label>
            <input class="form-control" name="cardsInDeck" value="<?php echo isset($cardsInDeck) ? $cardsInDeck : "" ?>">
        </div>
        <button class="btn btn-primary mt-4" type="submit" style="width:100%;">Submit</button>
    </form>
</div>
<?php include "./utils/footer.php"; ?>