<?php

function removeURLParams($url) {
    $params = explode("?", $url);
    if (count($params) == 2) {
        $url = str_replace("?" . $params[1], "", $url);
    }
    return $url;
}

function getURLFile($url = NULL) {
    if ($url == NULL) {
        $url = removeURLParams($_SERVER['SCRIPT_NAME']);
    }
    if (substr($url, -3) == "php") {
        $parts = explode("/", $url);
        return $parts[count($parts) - 1];
    }
    return null;
}

function getBaseUrl() {
    $url = $_SERVER['SCRIPT_NAME'];
    $url = removeURLParams($url);
    $file = getURLFile();
    if (isset($file)) {
        $url = str_replace($file, "", $url);
    }
    return $url;
}

function getCurrentUrl() {
    return $_SERVER['REQUEST_URI'];
}

function urlMatchPath($pathRoot, $url) {
    $result = array();
    $pattern = str_replace("/", "\/", $pathRoot);
    preg_match('/'. $pattern . '/', $url, $result);
    return (count($result) > 0);
}

function getCurrentTimestamp() {
    $now = new DateTime(null, new DateTimeZone("Europe/Prague"));
    return $now->getTimestamp();
}

function getPrintablePrivilege($privilege) {
    switch ($privilege) {
        case PRIVILEGE_CUSTOMER:
            return "Zákazník";
        case PRIVILEGE_MANAGER:
            return "Manager";
        case PRIVILEGE_ADMINISTRATOR:
            return "Administrátor";
        default:
            return "Nedefinováno";
    }
}