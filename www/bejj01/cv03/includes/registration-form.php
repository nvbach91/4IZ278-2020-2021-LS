<?php
$alerts = [];
$invalid = [];
$genderValues = ['F', 'M', 'O'];
$deckTypes = ['W', 'M', 'P', 'S'];
$alertStyle = 'bg-danger text-white';
$formSubmitted = !empty($_POST);
$minCards = 32;
$maxCards = 100;

if ($formSubmitted) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $deckName = htmlspecialchars(trim($_POST['deck']));
    $numberOfCards = htmlspecialchars(trim($_POST['cards']));


    if (empty($name)) {
        array_push($alerts, 'Please enter your name');
        array_push($invalid, 'name');
    }

    if (!in_array($gender, $genderValues)) {
        array_push($alerts, 'Please select a gender');
        array_push($invalid, 'gender');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($alerts, 'Please enter valid email address');
        array_push($invalid, 'email');
    }

    if (!preg_match('/^(\+\d{3}[ -]?)?(\d{3}[ -]?){3}$/', $phone)) {
        array_push($alerts, 'Please enter valid phone number');
        array_push($invalid, 'phone');
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($alerts, 'Please enter valid URL address');
        array_push($invalid, 'avatar');
    }

    if (!in_array($deckName, $deckTypes)) {
        array_push($alerts, 'Please select a deck type');
        array_push($invalid, 'deck');
    }

    if (!is_numeric($numberOfCards)) {
        array_push($alerts, 'Number of cards must be a number');
        array_push($invalid, 'cards');
    }
    else {
        $number = number_format($numberOfCards);
        if ($number < $minCards) {
            array_push($alerts, 'You do not have enough cards to enter the tournament');
            array_push($invalid, 'cards');
        }
        else if ($number > $maxCards) {
            array_push($alerts, 'Your deck is invalid. You have too many cards in it.');
            array_push($invalid, 'cards');
        }
    }
    

    if (!count($invalid)) {
        $alertStyle = 'bg-success text-light';
        $alerts = ['Congratulations! You are signed up to the best card tournament ever!'];
    }
}

?>

<div class="row justify-content-center">
    <?php if ($formSubmitted): ?>
        <?php foreach($alerts as $alert): ?>
        <div class="alert <?php echo $alertStyle ?>">
            <?php echo $alert?>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="row">
    <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label>
                <h3>Name</h3>
            </label>
            <input class="form-control <?php echo in_array('name', $invalid) ? 'is-invalid' : '' ?>" name="name" placeholder="Enter your name" value="<?php echo isset($name) ? $name : '' ?>">
            <?php if(in_array('name', $invalid)): ?>
                <small class="text-white bg-danger">For example: Karel Novák</small>
            <?php endif ?>
        </div>
        <div class="form-group">
            <label>
                <h3>Gender</h3>
            </label>
            <div class="radio-button-item row">
                <input
                    checked
                    class="form-control radio"
                    type="radio"
                    name="gender"
                    value="M"
                    <?php echo isset($gender) && $gender === 'M' ? 'checked' : '' ?>>
                <label for="M">Male</label>
            </div>
            <div class="radio-button-item row">
                <input
                    class="form-control radio"
                    type="radio"
                    name="gender"
                    value="F"
                    <?php echo isset($gender) && $gender === 'F' ? 'checked' : '' ?>>
                <label for="F">Female</label>
            </div>
            <div class="radio-button-item row">
                <input
                    class="form-control radio"
                    type="radio"
                    name="gender"
                    value="O"
                    <?php echo isset($gender) && $gender === 'O' ? 'checked' : '' ?>>
                <label for="O">Other</label>
            </div>
        </div>
        <div class="form-group">
            <label>
                <h3>Email Address</h3>
            </label>
            <input class="form-control <?php echo in_array('email', $invalid) ? 'is-invalid' : '' ?>" placeholder="Enter your email address" name="email" value="<?php echo isset($email) ? $email : '' ?>">
            <?php if(in_array('email', $invalid)): ?>
                <small class="text-white bg-danger">For example: novak@gmail.com</small>
            <?php endif ?>
        </div>
        <div class="form-group">
            <label>
                <h3>Phone Number</h3>
            </label>
            <input class="form-control <?php echo in_array('phone', $invalid) ? 'is-invalid' : '' ?>" placeholder="Enter your phone number" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
            <?php if(in_array('phone', $invalid)): ?>
                <small class="text-white bg-danger">For example: +420 111 222 333</small>
            <?php endif ?>
        </div>
        <div class="form-group">
            <label>
                <h3>Avatar URL</h3>
            </label>
            <input class="form-control <?php echo in_array('avatar', $invalid) ? 'is-invalid' : '' ?>" placeholder="Enter URL address of your selected avatar" name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
            <?php if(in_array('avatar', $invalid)): ?>
                <small class="text-white bg-danger">For example: https://www.example.com/img/avatar.jpg</small>
            <?php endif ?>
        </div>
        <div class="form-group">
            <label>
                <h3>Card Deck</h3>
            </label>
            <select class="form-control" name="deck">
                <option value="W"<?php echo isset($deckName) && $deckName === 'W' ? ' selected' : '' ?>>Warrior</option>
                <option value="M"<?php echo isset($deckName) && $deckName === 'M' ? ' selected' : '' ?>>Mage</option>
                <option value="P"<?php echo isset($deckName) && $deckName === 'P' ? ' selected' : '' ?>>Palladin</option>
                <option value="S"<?php echo isset($deckName) && $deckName === 'S' ? ' selected' : '' ?>>Shaman</option>
            </select>
            <small class="text-white">Choose your deck type</small>
        </div>
        <div class="form-group">
            <label>
                <h3>Number of Cards</h3>
            </label>
            <input class="form-control <?php echo in_array('cards', $invalid) ? 'is-invalid' : '' ?>" placeholder="Enter number of cards in your deck" name="cards" value="<?php echo isset($numberOfCards) ? $numberOfCards : '' ?>">
            <?php if(in_array('cards', $invalid)): ?>
                <small class="text-white bg-danger">For example: 55</small>
            <?php endif ?>
        </div>
        <hr>
        <div class="row justify-content-center">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
    <?php if(isset($avatar) && !in_array('avatar', $invalid)): ?>
        <img style="height: 200px;" src="<?php echo isset($avatar) ? $avatar : '' ?>" alt="player avatar">
    <?php endif ?>
</div>
