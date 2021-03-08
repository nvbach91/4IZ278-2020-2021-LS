<?php

require __DIR__ . "/../autoloader.php";

use cv04\src\authentication\Authentication;
use cv04\src\services\UserService;
use cv04\src\utilities\Redirect;

$service = new UserService();
$authentication = new Authentication();

if (!$authentication->check()) {
    Redirect::to("../auth/login.php");
}

$users = $service->users();

require __DIR__ . "/../templates/admin/users.php";