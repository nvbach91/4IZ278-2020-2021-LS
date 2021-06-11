<?php

class Router
{

    public static $routes = [
        "" => "Home",
        "login" => "Login",
        "register" => "Registration",
        "order" => "Order",
        "payment" => "Payment",
        "summary" => "Summary",
        "google" => "Google",
        "profile" => "Profile"
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
            $controller = new NotFoundController();
        }
        echo $controller->performAction();
    }

}