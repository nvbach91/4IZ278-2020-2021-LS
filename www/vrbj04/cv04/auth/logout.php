<?php

use cv04\src\authentication\Authentication;
use cv04\src\utilities\Redirect;

require __DIR__ . "/../autoloader.php";

$authentication = new Authentication();
$authentication->logout();

Redirect::to("./login.php");