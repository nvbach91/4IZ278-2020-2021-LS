<?php

use cv05\src\authentication\Authentication;
use cv05\src\requests\LoginRequest;
use cv05\src\utilities\Redirect;

require __DIR__ . "/../autoloader.php";

$authentication = new Authentication();
$violations = [];

if ($authentication->check()) {
    Redirect::to("../index.php");
}

function processLogin(array $violations, Authentication $authentication): array
{
    if ($authentication->check() ||
        $authentication->login($_POST["email"], $_POST["password"])) {
        Redirect::to("../index.php");
    }

    $violations["password"] = "Bad credentials";
    return $violations;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $violations = (new LoginRequest())->violations($_POST);

    if (empty($violations)) {
        $violations = processLogin($violations, $authentication);
    }
}

?>

<?php require __DIR__ . "/../templates/login.php" ?>
