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