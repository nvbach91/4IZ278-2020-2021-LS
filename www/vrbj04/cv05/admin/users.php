<?php

require __DIR__ . "/../autoloader.php";

use cv05\src\authentication\Authentication;
use cv05\src\services\UserService;
use cv05\src\utilities\Redirect;

$service = new UserService();
$authentication = new Authentication();

if (!$authentication->check()) {
    Redirect::to("../auth/login.php");
}

$users = $service->users();

require __DIR__ . "/../templates/admin/users.php";