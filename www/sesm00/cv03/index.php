<?php

include __DIR__ . '/includes/head.php';


$isSubmited = !empty($_POST);

$errors = array();

$validForm = false;

if ($isSubmited) {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $avatar = htmlspecialchars(trim($_POST["avatar"]));

    $phone = str_replace(" ", "", $phone);

    if (!$name) {
        array_push($errors, "Jméno je prázdné");
    }

    if (!$email) {
        array_push($errors, "Email je prázdný");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email je neplatný");
    }

    if (!$phone) {
        array_push($errors, "Telefon je prázdný");
    }
    if (!preg_match('/^[0-9]{9,}$/', $phone)) {
        array_push($errors, "Telefon je neplatný. Zadejte 9 číslic bez předvolby");
    }

    if (!$avatar) {
        array_push($errors, "Avatar je prázdný");
    }

    $validForm = !count($errors);

}

?>


<form method="POST" class="form-signin">
    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <?php if ($isSubmited && $validForm) : ?>
        <div class="alert alert-success" role="alert">
            Účet úspěšně vytvořen
        </div>
        <img src="<?php echo $avatar; ?>" class="mb-4" alt="avatar" width="72" height="72">
    <?php endif; ?>
    <h1 class="h3 mb-3 font-weight-normal">Registration form</h1>
    <div class="form-group">
        <label for="inputName" class="sr-only">Name</label>
        <input name="name" type="text" id="inputName" class="form-control" placeholder="Name" value="<?php echo empty($name) ? "" : $name; ?>" autofocus="">
    </div>
    <div class="form-group">
        <select class="custom-select" name="gender">
            <option <?php echo !isset($gender) || $gender == "N" ? "selected" : "" ?> value="N">Neutral</option>
            <option <?php echo isset($gender) && $gender == "F" ? "selected" : "" ?> value="F">Female</option>
            <option <?php echo isset($gender) && $gender == "M" ? "selected" : "" ?> value="M">Male</option>
        </select>
    </div>
    <div class="form-group">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="email" type="text" id="inputEmail" class="form-control" placeholder="Email address" value="<?php echo empty($email) ? "" : $email; ?>">
    </div>
    <div class="form-group">
        <label for="inputPhone" class="sr-only">Phone</label>
        <input name="phone" type="text" id="inputPhone" class="form-control" placeholder="Phone" value="<?php echo empty($phone) ? "" : $phone; ?>">
    </div>
    <div class="form-group">
        <label for="inputAvatar" class="sr-only">Avatar URL</label>
        <input name="avatar" type="text" id="inputAvatar" class="form-control" placeholder="Avatar" value="<?php echo empty($avatar) ? "" : $avatar; ?>">
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
</form>


<?php include __DIR__ . '/includes/foot.php'; ?>