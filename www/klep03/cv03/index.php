<?php include __DIR__ . '/includes/head.php' ?>
<?php

$isSubmitted = false;
$isSubmitted = empty($_POST) ? false : true;

$invalidInputs = [];

if ($isSubmitted) {
    //var_dump($_GET); // $_POST
    $email    = htmlspecialchars(trim($_POST['email']));
    $name = htmlspecialchars(trim($_POST['name']));
    $remember = isset($_POST['remember']) ? true : false;
    $gender = htmlspecialchars(trim($_POST['gender']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $profilePicture = htmlspecialchars(trim($_POST['profilePicture']));
    $deckType = htmlspecialchars(trim($_POST['deckType']));
    $numOfCards = htmlspecialchars(trim($_POST['numOfCards']));

    //echo $email;
    if (!$email) {
        array_push($invalidInputs, 'Email je prazdny!');
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Email je neplatny!');
    }
    if (!$gender) {
        array_push($invalidInputs, 'Gender je prazdny!');
    }
    if (!$phone) {
        array_push($invalidInputs, 'Telefon je prazdny!');
    }
    if (!$profilePicture) {
        array_push($invalidInputs, 'Profilovy obrazek je prazdny!');
    }
    if (!$deckType) {
        array_push($invalidInputs, 'Neni vyplnen typ balicku karet!');
    }
    if (!$numOfCards) {
        array_push($invalidInputs, 'Pocet karet je prazdny!');
    }
    else {
        if ($numOfCards < 1) {
            array_push($invalidInputs, 'Pocet karet je nekladny!');
        }
    }
}
if (count($invalidInputs) >= 0) {
    $isValidForm = false;
}
else {
    $isValidForm = true;
}

//echo $invalidInputs;
if ($isValidForm) {
    // do something more
}
// echo
?>

<main>
    <h1>Sign up for next epic game!</h1>
    <?php if ($isSubmitted) : ?>
        <h2>You have submitted the form.</h2>
    <?php endif; ?>

    <?php if ($isValidForm) : ?>
        <h2>The form is valid, you are awesome.</h2>
    <?php elseif (!$isSubmitted) : ?>

    <?php else : ?>
        <h2>The form is not valid, please try again.</h2>
    <?php endif; ?>

    <?php foreach ($invalidInputs as $invalidInput) : ?>
        <p class="error-message"><?php echo $invalidInput; ?></p>
    <?php endforeach; ?>

    <?php if (isset($_POST['profilePicture'])) : ?>
        <img src="<?php echo $_POST['profilePicture']; ?>" alt="avatar">
    <?php endif; ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <div class="mb-3">
            <label class="form-label">Full name</label>
            <input value="<?php echo isset($email) ? $email : ''; ?>" name="name" class="form-control" id="fullName" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">I identify myself as</label>
            <select id="gender" name="gender" class="form-control" id="gender">
                <option value="man">Man</option>
                <option value="woman">Woman</option>
                <option value="I'd rather not answer">I'd rather not answer</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input value="<?php echo isset($email) ? $email : ''; ?>" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input value="<?php echo isset($phone) ? $phone : ''; ?>" name="phone" class="form-control" id="phone">
        </div>
        <div class="mb-3">
            <label class="form-label">Profile picture</label>
            <input value="<?php echo isset($profilePicture) ? $profilePicture : ''; ?>" name="profilePicture" class="form-control" id="profilePicture" aria-describedby="profilePictureHelp">
            <div id="profilePictureHelp" class="form-text">Enter a valid url.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Deck type</label>
            <input value="<?php echo isset($deckType) ? $deckType : ''; ?>" name="deckType" class="form-control" id="deckType">
        </div>
        <div class="mb-3">
            <label class="form-label">Number of cards</label>
            <input value="<?php echo isset($numOfCards) ? $numOfCards : ''; ?>" name="numOfCards" class="form-control" id="numOfCards">
        </div>
        <div class="mb-3 form-check">
            <input <?php echo isset($remember) && $remember == true ? 'checked' : ''; ?> name="remember" type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>
<?php include __DIR__ . '/includes/foot.php' ?>