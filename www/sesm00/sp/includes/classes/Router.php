<?php

class Router
{

    public static $routes = [
        "" => "Home",
        "login" => "Login"
    ];

    public static function performRouting() {
        if (!isset($_GET['url'])) {
            $route = "";
        } else {
            $route = $_GET['url'];
        }
        if (isset(self::$routes[$route])) {
            $class = self::$routes[$route] . "Controller";
            $controller = new $class();
        } else {
            //  TODO: call 404 controller
            //$controller = "404";
        }
        echo $controller->performAction();
    }

    public static function installHtaccess() {
        if(!file_exists(__DIR__ . "/../../.htaccess")){
            $content = "<IfModule mod_rewrite.c>\r\n" .
                "RewriteEngine on\r\n" .
                "RewriteBase " . BASE_URL . "\r\n" .
                "RewriteRule ^index\.php$ - [L]\r\n" .
                "RewriteCond %{REQUEST_FILENAME} !-f\r\n" .
                "RewriteCond %{REQUEST_FILENAME} !-d\r\n" .
                "RewriteRule ^(.+)$ " . BASE_URL . "index.php?url=$1 [L,QSA]\r\n" .
                "</IfModule>";
            file_put_contents(__DIR__ . "/../../.htaccess", $content, LOCK_EX);
        }
    }

}