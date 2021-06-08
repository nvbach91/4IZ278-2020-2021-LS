<?php
require_once __DIR__ . '/includes/utils/baseHelper.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/vendor/autoload.php';

function custom_autoloader($className) {
    if(file_exists(__DIR__ . "/controllers/" . $className . ".php")){
        require __DIR__ . "/controllers/" . $className . '.php';
        return true;
    }elseif(file_exists(__DIR__ . "/includes/classes/" . $className . ".php")) {
        require __DIR__ . "/includes/classes/" . $className . '.php';
        return true;
    }elseif(file_exists(__DIR__ . "/includes/interfaces/" . $className . ".php")) {
        require __DIR__ . "/includes/interfaces/" . $className . '.php';
        return true;
    }
    return false;
}


spl_autoload_register("custom_autoloader");

Router::performRouting();




