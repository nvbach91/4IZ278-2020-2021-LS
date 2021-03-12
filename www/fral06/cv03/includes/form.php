<?php

require __DIR__ . '/../utils.php';
//var_dump($_GET);

$isSubmited = empty($_POST) ? false : true;
$alertType = 'alert-danger';
$invalidInputs = [];
$invalidMessages = [];

if ($isSubmited) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $packageName = htmlspecialchars(trim($_POST['packageName']));
    $numberOfCards = htmlspecialchars((trim($_POST['numberOfCard'])));


    // empty name
    if (!$name) {
        array_push($invalidMessages, 'Please enter your name.');
        array_push($invalidInputs, 'name');
        array_push($invalidInputs, 'name');
    }

    // invalid gender
    if (!in_array($gender, ['N', 'F', 'M'])) {
        array_push($invalidMessages, 'Please select a gender.');
        array_push($invalidInputs, 'gender');
    }

    //empty mail
    if (!$email) {
        array_push($invalidMessages, 'Email is empty.');
        array_push($invalidInputs, 'email');
    }

    //invalid mail
    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidMessages, 'Email is invalid.');
        array_push($invalidInputs, 'email');
    }

    // invalid URL
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($invalidMessages, 'Please use a valid URL for your avatar.');
        array_push($invalidInputs, 'avatar');
    }

    //invalid phone
    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        array_push($invalidMessages, 'Please use a valid phone number.');
        array_push($invalidInputs, 'phone');
    }

    //empty package
    if (!$packageName) {
        array_push($invalidMessages, 'Please enter your package name.');
        array_push($invalidInputs, 'packageName');
    }

    //empty package
    if (!is_numeric($numberOfCards) || $numberOfCards <= 0) {
        array_push($invalidMessages, 'Number of cards has to be greater than zero.');
        array_push($invalidInputs, 'numberOfCards');
    }

    // if no errors: send an confirmation email
    if (!count($invalidMessages)) {
        if (!sendEmail($email, 'Registration confirmation')) {
            array_push($invalidMessages, 'There was a problem sending email');
        }
    }

    // if no errors at all: display success
    if (!count($invalidMessages)) {
        $alertType = 'alert-success';
        $invalidMessages = ['You have successfully signed up!'];
    }
}

?>

<?php if ($isSubmited): ?>
    <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $invalidMessages); ?></div>
<?php endif; ?>

<form class="form-signup" method="post">
    <div class="form-group mb-3">
        <label for="name">Name*</label>
        <input id="name" class="form-control <?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>"
               name="name" value="<?php echo isset($name) ? $name : '' ?>">
    </div>
    <div class="form-group mb-3">
        <label for="gender">Gender*</label>
        <select id="gender" class="form-control <?php echo in_array('gender', $invalidInputs) ? ' is-invalid' : '' ?>"
                type="" name="gender">
            <option value="N" <?php echo isset($gender) && $gender === 'N' ? ' selected' : '' ?>>Neutral</option>
            <option value="M" <?php echo isset($gender) && $gender === 'M' ? ' selected' : '' ?>>Male</option>
            <option value="F" <?php echo isset($gender) && $gender === 'F' ? ' selected' : '' ?>>Female</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input id="email" class="form-control <?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>"
               name="email" value="<?php echo isset($email) ? $email : '' ?>">
    </div>
    <div class="form-group mb-3">
        <label for="phone">Phone</label>
        <input id="phone" class="form-control <?php echo in_array('phone', $invalidInputs) ? ' is-invalid' : '' ?>"
               name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
    </div>
    <div class="form-group mb-3">
        <label for="avatar">Avatar URL</label>
        <img class="avatar" src="<?php echo $avatar; ?>" alt="avatar">
        <input id="avatar" class="form-control <?php echo in_array('avatar', $invalidInputs) ? ' is-invalid' : '' ?>"
               name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
    </div>
    <div class="form-group mb-3">
        <label for="packageName">Package name</label>
        <input id="packageName"
               class="form-control <?php echo in_array('packageName', $invalidInputs) ? ' is-invalid' : '' ?>"
               name="packageName"
               value="<?php echo isset($packageName) ? $packageName : '' ?>">
    </div>
    <div class="form-group mb-3">
        <label for="numberOfCards">Number of cards</label>
        <input id="numberOfCards"
               class="form-control <?php echo in_array('numberOfCards', $invalidInputs) ? ' is-invalid' : '' ?>"
               name="numberOfCard"
               value="<?php echo isset($numberOfCards) ? $numberOfCards : '' ?>">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
