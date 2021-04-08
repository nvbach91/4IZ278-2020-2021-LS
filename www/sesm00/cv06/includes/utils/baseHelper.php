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
        $url = removeURLParams($_SERVER['REQUEST_URI']);
    }
    if (substr($url, -3) == "php") {
        $parts = explode("/", $url);
        return $parts[count($parts) - 1];
    }
    return null;
}

function getBaseUrl() {
    $url = $_SERVER['REQUEST_URI'];
    $url = removeURLParams($url);
    $url = str_replace("/admin", "", $url);
    $file = getURLFile();
    if (isset($file)) {
        $url = str_replace($file, "", $url);
    }
    return $url;
}