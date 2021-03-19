<?php

use cv05\src\authentication\Authentication;
use cv05\src\utilities\Redirect;

require __DIR__ . "/../autoloader.php";

$authentication = new Authentication();
$authentication->logout();

Redirect::to("./login.php");