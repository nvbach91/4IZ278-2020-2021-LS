<?php include __DIR__ . '/includes/header.php' ?>
<?php

$invalidInputs = [];
$msg = '';
$alertType = 'alert-danger';
$isSubmitted = !empty($_POST);

if ($isSubmitted) {

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $package = htmlspecialchars(trim($_POST['package']));
    $cards = htmlspecialchars(trim($_POST['cards']));

    if (!preg_match('/^(?:\b[A-Ž]+\b[\s\r\n]*){2,4}$/', $name)) {
        if (!$name) {
            array_push($invalidInputs, 'Please, fill the name in');
        } else {
        array_push($invalidInputs, 'Name is not valid');
        }
    }
    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        if (!$phone) {
            array_push($invalidInputs, 'Please, fill the phone in');
        } else {
        array_push($invalidInputs, 'Phone is not valid');
        }
    }
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        if (!$avatar) {
            array_push($invalidInputs, 'Please, fill the avatar in');
        } else {
        array_push($invalidInputs, 'Avatar is not valid');
        }
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (!$email) {
            array_push($invalidInputs, 'Please, fill the email in');
        } else {
        array_push($invalidInputs, 'Email is not valid');
        }
    }
    if (!count($invalidInputs)) {
        $alertType = 'alert-success';
        array_push($invalidInputs, 'You have successfuly logged in');
    }
}
?>
<main>
    <h1>Sign up via this form</h1>
    <form class="form-signup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <?php if ($isSubmitted) : ?>
            <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $invalidInputs); ?></div>
        <?php endif; ?>
        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label>Phone*</label>
            <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
        </div>
        <div class="form-group">
            <label>Avatar URL*</label>
            <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
            <?php if (isset($avatar) && $avatar) : ?>
                <img class="avatar" src="<?php echo $avatar; ?>" alt="avatar">
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>Package</label>
            <input class="form-control" name="package" value="<?php echo isset($package) ? $package : '' ?>">
        </div>
        <div class="form-group">
            <label>Cards in package</label>
            <input class="form-control" name="cards" value="<?php echo isset($cards) ? $cards : '' ?>">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</main>
<?php include __DIR__ . '/includes/footer.php' ?>