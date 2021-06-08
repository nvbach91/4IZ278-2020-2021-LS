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
    if (defined("BASE_URL")) {
        return BASE_URL;
    }
    $url = $_SERVER['SCRIPT_NAME'];
    $url = removeURLParams($url);
    $file = getURLFile();
    if (isset($file)) {
        $url = str_replace($file, "", $url);
    }
    return $url;
}

function getCurrentUrl($withUriParams = true) {
    $uri = $_SERVER['REQUEST_URI'];
    if (!$withUriParams) {
        $uri = explode("?", $uri)[0];
    }
    return $uri;
}

function urlMatchPath($pathRoot, $url) {
    $result = array();
    $pattern = str_replace("/", "\/", $pathRoot);
    preg_match('/'. $pattern . '/', $url, $result);
    return (count($result) > 0);
}

function getCurrentTimestamp() {
    $now = new DateTime(null, new DateTimeZone(TIME_ZONE));
    return $now->getTimestamp();
}

function getCurrentFormatedTime() {
    $now = new DateTime(null, new DateTimeZone(TIME_ZONE));
    return $now->format('Y-m-d H:i:s');
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

function getCookiePath() {
    return substr(BASE_URL, 0, (strlen(BASE_URL) - 1));
}

function formatPrice($number) {
    return number_format($number, 0, ",", " ");
}

function getProtocol() {
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
        return "https://";
    }
    return "http://";
}

function isPhoneNumber($phone) {
    $results = array();
    preg_match('/^(\+\d{3})?\d{3}\d{3}\d{3}$/', $phone, $results);
    if (count($results) > 0) {
        return true;
    }
    return false;
}