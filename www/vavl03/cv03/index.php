<?php 
$invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-danger';

$submittedForm = !empty($_POST);
if ($submittedForm) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $cardsName= htmlspecialchars(trim($_POST['cardsName']));
    $numberOfCards= htmlspecialchars(trim($_POST['numberOfCards']));

    if (!$name) {
        array_push($alertMessages, 'Please enter your name');
        array_push($invalidInputs, 'name');
    }

    if (!in_array($gender, ['N', 'F', 'M'])) {
        array_push($alertMessages, 'Please select a gender');
        array_push($invalidInputs, 'gender');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($alertMessages, 'Please use a valid email');
        array_push($invalidInputs, 'email');
    }

    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        array_push($alertMessages, 'Please use a valid phone number');
        array_push($invalidInputs, 'phone');
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($alertMessages, 'Please use a valid URL for your avatar');
        array_push($invalidInputs, 'avatar');
    }

    if(!$cardsName){
        array_push($alertMessages, 'Please enter your cards pack name');
        array_push($invalidInputs, 'cardsName');
    }
    if(!is_numeric($numberOfCards)){
        array_push($alertMessages, 'Please enter valid number of cards');
        array_push($invalidInputs, 'numberOfCards');
    }

    if (!count($alertMessages)) {
        $alertType = 'alert-success';
        $alertMessages = ['Woohoo! You have successfully signed up!'];
    }
}

?>
<?php require './components/header.php'; ?>
<main class="container">
    <br>
    <h2 class="text-center">Registration form for poker tournament</h2>
    <div class="row justify-content-center">
        <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php if ($submittedForm): ?>
            <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label>Name*</label>
                <input class="form-control<?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>" name="name" value="<?php echo isset($name) ? $name : '' ?>">
                <small class="text-muted">Example: Connor Kenway</small>
            </div>
            <div class="form-group">
                <label>Gender*</label>
                <select class="form-control" name="gender">
                    <option value="N"<?php echo isset($gender) && $gender === 'N' ? ' selected' : '' ?>>Neutral</option>
                    <option value="F"<?php echo isset($gender) && $gender === 'F' ? ' selected' : '' ?>>Female</option>
                    <option value="M"<?php echo isset($gender) && $gender === 'M' ? ' selected' : '' ?>>Male</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input class="form-control<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" name="email" value="<?php echo isset($name) ? $email : '' ?>">
                <small class="text-muted">Example: example@gmail.com</small>
            </div>
            <div class="form-group">
                <label>Phone*</label>
                <input class="form-control<?php echo in_array('phone', $invalidInputs) ? ' is-invalid' : '' ?>" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
                <small class="text-muted">Example: +421 841 147 239</small>
            </div>
            <div class="form-group">
                <label>Avatar URL*</label>
                <?php if (isset($avatar) && $avatar): ?>
                <img class="avatar" src="<?php echo $avatar; ?>" alt="avatar">
                <?php endif; ?>
                <input class="form-control<?php echo in_array('avatar', $invalidInputs) ? ' is-invalid' : '' ?>" name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
                <small class="text-muted">Example: https://eso.vse.cz/~vavl03/cv03/img/connor.jpg</small>
            </div>
            <div class="form-group">
                <label>Cards pack name*</label>
                <input class="form-control<?php echo in_array('cardsName', $invalidInputs) ? ' is-invalid' : '' ?>" name="cardsName" value="<?php echo isset($cardsName) ? $cardsName : '' ?>">
                <small class="text-muted">Example: texas-holdem</small>
            </div>
            <div class="form-group">
                <label>Number of cards in pack*</label>
                <input class="form-control<?php echo in_array('numberOfCards', $invalidInputs) ? ' is-invalid' : '' ?>" name="numberOfCards" value="<?php echo isset($numberOfCards) ? $numberOfCards : '' ?>">
                <small class="text-muted">Example: 52</small>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</main>
<?php require './components/footer.php'; ?>