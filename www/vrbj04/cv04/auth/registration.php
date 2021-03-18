<?php

use cv04\src\requests\RegistrationRequest;
use cv04\src\services\UserService;

require __DIR__ . "/../autoloader.php";

$violations = [];

function processRegistration(array $violations): array {
    $service = new UserService();

    // Check if the username is not in the database already
    if ($service->findUserByUsername($_POST["username"]) !== null) {
        $violations["username"] = "This username is already taken.";
        return $violations;
    }

    // Check if the email is not in the database already
    if ($service->findUserByEmail($_POST["email"]) !== null) {
        $violations["email"] = "This email is already taken.";
        return $violations;
    }

    // Check if password is confirmed
    if (!isset($_POST["password_confirmation"]) || $_POST["password"] !== $_POST["password_confirmation"]) {
        $violations["password_confirmation"] = "Password confirmation doesn't match.";
        return $violations;
    }

    // Register user into database
    $service->register($_POST["username"], $_POST["email"], $_POST["password"]);

    // Return redirect to login.php
    header("Location: login.php?successfully-registered");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $violations = (new RegistrationRequest())->violations($_POST);

    if (empty($violations)) {
        $violations = processRegistration($violations);
    }
}

?>

<?php require __DIR__ . "/../templates/registration.php" ?>
