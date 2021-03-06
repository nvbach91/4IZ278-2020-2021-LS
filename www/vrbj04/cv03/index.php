<?php

require __DIR__ . "/Registration.php";
require __DIR__ . "/Validator.php";

$violations = [];

// process the registration
if (!empty($_POST)) {
    $validator = new Validator($_POST);

    if ($validator->validate()) {
        $registration = new Registration(
            $_POST["name"],
            $_POST["gender"],
            $_POST["email"],
            $_POST["phone"],
            $_POST["avatarURL"],
            $_POST["deckName"],
            (int) $_POST["deckSize"],
        );

        require __DIR__ . "/templates/successful-registration.php";
    }
    else {
        $violations = $validator->getViolatedRules();
    }
}

require __DIR__ . "/templates/form.php";