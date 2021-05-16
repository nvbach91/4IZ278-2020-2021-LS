<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", true);
ini_set("display_startup_errors", true);

spl_autoload_register(static function ($class) {
    $path = str_replace("\\", "/", $class);
    $file = __DIR__ . "/" . str_replace("cv05/", "", $path) . ".php";

    if (file_exists($file)) {
        /** @noinspection PhpIncludeInspection */
        require $file;
    }
}); 