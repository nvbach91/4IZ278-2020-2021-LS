<?php include  './includes/header.php'; ?>
<?php $invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-danger';

// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {
    //var_dump($_POST);
    // get all fields while trimming them and converting any special chars to html entities
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));

    if (!$name) {
        array_push($alertMessages, 'Please enter your name');
        array_push($invalidInputs, 'name');
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

    if (!count($alertMessages)) {
        $alertType = 'alert-success';
        $alertMessages = ['Woohoo! You have successfully signed up!'];
    }
}
?>

<header class="header">
        <p class="header-title">gulm04</p>
        <div class="menu">
        <ul class="menu-list">
            <li><a href="#">Home</a></li>
            <li><a href="#">Features</a></li>
            <li><a href="#">Pricing</a></li>
            <li><a href="#">About</a></li>
        </ul>
        <form class="menu-form">
            <input class="menu-search-input" type="text" placeholder=" Search">
            <button class="btn menu-search-btn" id="menu-search-btn">Search</button>
        </form>
        </div>
    </header>
    <main class="main">
        <br>
        <h1>Form validation example</h1>
        <h3>Registration form</h3>
        <div class="row justify-content-center">
            <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <?php if ($submittedForm): ?>
                <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
                <?php endif; ?>
                    <div class="form-group">
                        <label>Name*</label>
                        <input class="form-control<?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>" name="name" value="<?php echo isset($name) ? $name : '' ?>">
                        <small class="text-muted">You need to fill your full name</small>
                    </div>
                    <div class="form-group">
                        <label>Gender*</label>
                        <select class="form-control" name="gender">
                            <option value="N">Neutral</option>
                            <option value="F">Female</option>
                            <option value="M">Male</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email*</label>
                        <input class="form-control<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" name="email" value="<?php echo isset($name) ? $email : '' ?>">
                        <small class="muted-text">example@example.com</small>
                    </div>
                    <div class="form-group">
                        <label>Phone*</label>
                        <input class="form-control<?php echo in_array('phone', $invalidInputs) ? ' is-invalid' : '' ?>" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
                        <small class="muted-text">Example: +420 000 000 000</small>
                    </div>
                    <div class="form-group">
                        <?php if (isset($avatar) && $avatar): ?>
                        <img class="avatar" src="<?php echo $avatar; ?>" alt="avatar">
                        <?php endif; ?>
                        <label>Avatar URL*</label>
                        <input class="form-control<?php echo in_array('avatar', $invalidInputs) ? ' is-invalid' : '' ?>" name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
                        <small class="text-muted">Example: https://eso.vse.cz/~gulm04/cv03/avatar.jpg</small>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </main>

<?php include  "./includes/footer.php"; ?>