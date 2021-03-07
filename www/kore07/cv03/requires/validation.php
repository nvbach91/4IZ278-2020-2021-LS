<?php
    $errorMessages = [];
    $successMessage = 'You have submitted the form';
    $genderValues = ['Female', 'Male'];
    $isSubmitted = !empty($_POST);

    if ($isSubmitted) {
        $name = htmlspecialchars(trim($_POST['name']));
        $gender = htmlspecialchars(trim($_POST['gender']));
        $email = htmlspecialchars(trim($_POST['email']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        $image = htmlspecialchars(trim($_POST['image']));
        $deck = htmlspecialchars(trim($_POST['deck']));
        $count = htmlspecialchars(trim($_POST['count']));

        if (empty($name)) {
            array_push($errorMessages, 'Please enter your name');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errorMessages, 'Please enter a validni email');
        }

        if (!preg_match('/^(\+\d{3}[ -]?)?(\d{3}[ -]?){3}$/', $phone)) {
            array_push($errorMessages, 'Please enter a correct phone number');
        }

        if (!filter_var($image, FILTER_VALIDATE_URL)) {
            array_push($errorMessages, 'Please enter a validni image url');
        }

        if (!$deck) {
            array_push($errorMessages, 'Please enter your deck name');
        }

        if (!is_numeric($count)) {
            array_push($errorMessages, 'Please enter your number of cards');
        }
    }

?>