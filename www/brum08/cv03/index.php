<?php

$errorMessages = [];

$isSubmitted = !empty($_POST);
if ($isSubmitted) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));

    if (!$name) {
        array_push($errorMessages, 'Enter your name');
    }

    //Metoda kontroluje vybrané pohlaví, ale reálně se nepoužívá
    if (!in_array($gender, ['Female', 'Male'])) {
        array_push($errorMessages, 'Select a gender');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errorMessages, 'Use a valid email');
    }

    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        array_push($errorMessages, 'Use a valid phone number');
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        //odpovídá patternu URL na obrázky v img (v mé případě morče), aby se zobrazil aspoň nějaký obrázek, jinak URL se kontroluje
        if (preg_match('/^\.\/img\/[a-zA-Z]{1,}\.[a-z]{1,}$/', $avatar)) {
            //možná kontrola zda obrázek opravdu existuje (nevím jak)
        } else {
            array_push($errorMessages, 'Use a valid URL for your avatar');
        }
    }

    if (!count($errorMessages)) {
        $errorMessages = ['You have successfully signed up'];
    }
}

?>
<?php include './includes/header.php'; ?>
<main class="container">
    <h1 class="text-center">Registration form</h1>
    <div class="row justify-content-center">
        <form class="form-signup" method="POST">
            <?php if ($isSubmitted) : ?>
                <?php foreach ($errorMessages as $errormsg) : ?>
                    <p><?php echo $errormsg ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (isset($avatar) && $avatar) : ?>
                <img class="avatar" src="<?php echo $avatar; ?>" alt="avatar">
            <?php endif; ?>
            <div class="form-group">
                <label>Name:</label>
                <br>
                <input name="name" value="<?php echo isset($name) ? $name : '' ?>">
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <select class="form-control" name="gender">
                    <option value="Female" <?php echo isset($gender) && $gender === 'Female' ? ' selected' : '' ?>>Female</option>
                    <option value="Male" <?php echo isset($gender) && $gender === 'Male' ? ' selected' : '' ?>>Male</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <br>
                <input name="email" value="<?php echo isset($name) ? $email : '' ?>">
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <br>
                <input name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
            </div>
            <div class="form-group">
                <label>Avatar URL:</label>
                <br>
                <input name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</main>
<?php include './includes/footer.php'; ?>