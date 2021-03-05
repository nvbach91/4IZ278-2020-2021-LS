<?php 
$invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-danger';
$regexName = '~^(?:[\p{L}\p{Mn}\p{Pd}\'\x{2019}]+\s[\p{L}\p{Mn}\p{Pd}\'\x{2019}]+\s?)+$~u';
$regexMail = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
$regexPhone = '/^(\+\d{3} ?)?(\d{3} ?){3}$/';
// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {

    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $deck = htmlspecialchars(trim($_POST['deck']));
    $quantity = htmlspecialchars(trim($_POST['quantity']));

    // check name, regex allows unicode letters (abcd), accents (ěáí), hyphens(Anna-Marie), single quotes (Charlie O' Hara)
    if (!preg_match($regexName, $name)) {
        array_push($alertMessages, 'Please enter your name');
        array_push($invalidInputs, 'name');
    }

    // check gender
    if (!in_array($gender, ['F', 'M', 'O'])) {
        array_push($alertMessages, 'Please select a gender');
        array_push($invalidInputs, 'gender');
    }

    // check email, according to php docs validate email filter uses RFC 822 which is obsolete, lets use RFC 5322, internationalized mails wont work (e.g. 用户@例子.广告)
    if (!preg_match($regexMail, $email)) {
        array_push($alertMessages, 'Please use a valid email');
        array_push($invalidInputs, 'email');
    }

    // check phone number
    if (!preg_match($regexPhone, $phone)) {
        array_push($alertMessages, 'Please use a valid phone number');
        array_push($invalidInputs, 'phone');
    }

    // check avatar URL, internationalized urls wont work (e.g. http://例子.卷筒纸)
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($alertMessages, 'Please use a valid URL for your avatar');
        array_push($invalidInputs, 'avatar');
    }

    // check deck
    if (!in_array($deck, ['LA', 'DD', 'R', 'C'])) {
        array_push($alertMessages, 'Please select a deck');
        array_push($invalidInputs, 'deck');
    }

    // check card quantity
    if (!$quantity || $quantity < 20 || $quantity > 60) {
        array_push($alertMessages, 'Please use a valid quantity');
        array_push($invalidInputs, 'quantity');
    }

    // success
    if (!count($alertMessages)) {
        $alertType = 'alert-success';
        $alertMessages = ['Registration completed succesfully.'];
        mail($email,"Example form","Registration completed!");
    }
}
?>
<?php include './includes/header.php' ?>
<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
    <div class="inner">
        <h3 class="masthead-brand">Form</h3>
        <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link active" href="#">Home</a>
        <a class="nav-link" href="#">Features</a>
        <a class="nav-link" href="#">Contact</a>
        </nav>
    </div>
    </header>
    
    <main role="main" class="inner cover">
    <h1 class="text-center">Form validation example</h1>
    <form class="form-signup" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php if ($submittedForm): ?>
    <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
    <?php endif; ?>
        <div class="form-group">
            <label>Your name*</label>
            <input class="form-control <?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>" name="name" value="<?php echo isset($name) ? $name : '' ?>">
            <small class="text-muted">Example: Johnny Depp</small>
        </div>
        <div class="form-group">
            <label>Gender*</label>
            <select class="form-control" name="gender" value="">
                <option value="N"<?php echo isset($gender) && $gender === 'N' ? ' selected' : '' ?>></option>
                <option value="F"<?php echo isset($gender) && $gender === 'F' ? ' selected' : '' ?>>Female</option>
                <option value="M"<?php echo isset($gender) && $gender === 'M' ? ' selected' : '' ?>>Male</option>
                <option value="O"<?php echo isset($gender) && $gender === 'O' ? ' selected' : '' ?>>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" name="email" value="<?php echo isset($name) ? $email : '' ?>">
            <small class="text-muted">Example: example@google.com</small>
        </div>
        <div class="form-group">
            <label>Phone*</label>
            <input class="form-control<?php echo in_array('phone', $invalidInputs) ? ' is-invalid' : '' ?>" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
            <small class="text-muted">Example: +420 123 456 789</small>
        </div>
        <div class="form-group">
            <label>Avatar URL*</label>
            <?php if (isset($avatar) && $avatar): ?>
                <img class="avatar" src="<?php echo $avatar; ?>" alt="avatar">
            <?php endif; ?>
            <input class="form-control <?php echo in_array('avatar', $invalidInputs) ? ' is-invalid' : '' ?>" name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
            <small class="text-muted">Example: http://example.com/avatar.png</small>
        </div>
        <div class="form-group">
            <label>Deck*</label>
            <select class="form-control" name="deck" value="">
                <option value="N"<?php echo isset($deck) && $deck === 'N' ? ' selected' : '' ?>></option>
                <option value="LA"<?php echo isset($deck) && $deck === 'LA' ? ' selected' : '' ?>>Lightning Aggro</option>
                <option value="DD"<?php echo isset($deck) && $deck === 'DD' ? ' selected' : '' ?>>Deadly Discovery</option>
                <option value="R"<?php echo isset($deck) && $deck === 'R' ? ' selected' : '' ?>>Rowan</option>
                <option value="C"<?php echo isset($deck) && $deck === 'C' ? ' selected' : '' ?>>Custom</option>
            </select>
        </div>
        <div class="form-group">
            <label>Quantity*</label>
            <input class="form-control <?php echo in_array('quantity', $invalidInputs) ? ' is-invalid' : '' ?>" name="quantity" value="<?php echo isset($quantity) ? $quantity : ''; ?>">
            <small class="text-muted">Numbers from 20 to 60</small>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
    </main>
</div>
<?php include './includes/footer.php' ?>