<?php $invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-danger';
$isSubmitted = !empty($_POST);


if ($isSubmitted) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $deckName = htmlspecialchars(trim($_POST['deckName']));
    $numberOfCards = htmlspecialchars(trim($_POST['numberOfCards']));

    if (!$name) {
        array_push($invalidInputs, 'Please enter your name');
    }

    if (!in_array($gender, ['Male', 'Female', 'Other'])) {
        array_push($invalidInputs, 'Please enter your gender');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Please enter valid email');
    }

    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        array_push($invalidInputs, 'Please enter valid phone number');
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($invalidInputs, 'Please enter valid URL');
    }

    if (!$deckName) {
        array_push($invalidInputs, 'Please enter your deck name');
    }

    if (!$numberOfCards || $numberOfCards < 40 || $numberOfCards > 60) {
        array_push($invalidInputs, 'Please enter number of cards in your deck');
    }

    if (!count($invalidInputs)) {
        $alertType = 'alert-success';
        $successMessage = ['You have succesfully signed up'];
    }
}
?>
<?php include './includes/header.php' ?>
<main>
    <h1 class="title">Registration Form</h1>
    <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php if ($isSubmitted) : ?>
            <?php if (!empty($invalidInputs)) : ?>
                <?php foreach ($invalidInputs as $msg) : ?>
                    <div class="alert <?php echo $alertType; ?>"><?php echo $msg; ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (empty($invalidInputs)) : ?>
                <div class="alert <?php echo $alertType; ?>"><?php echo implode($successMessage); ?></div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="form-group">
            <label>Name</label>
            <input name="name" value="<?php echo isset($name) ? $name : '' ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <small class="fst-italic">Example: John Smith</small>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <select class="form-control" name="gender">
                <option hidden selected value></option>
                <option value="Male" <?php echo isset($gender) && $gender === 'Male' ? ' selected' : '' ?>>Male</option>
                <option value="Female" <?php echo isset($gender) && $gender === 'Female' ? ' selected' : '' ?>>Female</option>
                <option value="Other" <?php echo isset($gender) && $gender === 'Other' ? ' selected' : '' ?>>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input name="email" value="<?php echo isset($email) ? $email : '' ?>" class="form-control" id="exampleInputPassword1">
            <small class="fst-italic">Example: example@mail.com</small>
        </div>
        <div class="form-group">
            <label>Telefon</label>
            <input name="phone" value="<?php echo isset($phone) ? $phone : '' ?>" class="form-control" id="exampleInputPassword1">
            <small class="fst-italic">Example: +420 111 222 333</small>
        </div>
        <div class="form-group">
            <label>Avatar</label>
            <input name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>" class="form-control" id="exampleInputPassword1">
            <small class="fst-italic">Example: https://i.imgur.com/example.png</small>
        </div>
        <div class="form-group">
            <label>Název balíku</label>
            <input name="deckName" value="<?php echo isset($deckName) ? $deckName : '' ?>" class="form-control" id="exampleInputPassword1">
            <small class="fst-italic">Example: Blue sky</small>
        </div>
        <div class="form-group">
            <label>Počet karet v balíku</label>
            <input name="numberOfCards" value="<?php echo isset($numberOfCards) ? $numberOfCards : '' ?>" class="form-control" id="exampleInputPassword1">
            <small class="fst-italic">in the range of 40 to 60</small>
        </div>
        <div class="col text-center">
        <button type="submit" class="btn btn-primary ">Sign up</button>
        </div>
        
    </form>
</main>
<?php include './includes/footer.php' ?>