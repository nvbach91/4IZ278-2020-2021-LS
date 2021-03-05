<?php

require __DIR__ . "/Registration.php";
require __DIR__ . "/Validator.php";

$violations = [];

// process the registration
if (!empty($_POST)) {
    $validator = new Validator($_POST);

    if ($validator->validate()) {
        $gender = $_POST["gender"] === "m"
            ? Registration::GENDER_MALE
            : Registration::GENDER_FEMALE;

        $registration = new Registration(
            $_POST["name"],
            $gender,
            $_POST["email"],
            $_POST["phone"],
            $_POST["avatarURL"],
            $_POST["deckName"],
            (int) $_POST["deckSize"],
        );

        require __DIR__ . "/templates/successful-registration.php";
        exit;
    }
    else {
        $violations = $validator->getViolatedRules();
    }
}

require __DIR__ . "/templates/form.php";