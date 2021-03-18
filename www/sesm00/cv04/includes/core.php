<?php

define('DATABASE_FILE_NAME', __DIR__ . '/../database/users.db');

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

define('BASE_URL', getBaseUrl());

function fetchUsers() {
    $rows = file(DATABASE_FILE_NAME);
    $users = array();
    foreach ($rows as $row) {
        if (!$row) {
            continue;
        }
        $data = explode(";", $row);
        $users[$data[1]] = array("name" => $data[0], "email" => $data[1], "password" => str_replace("\r\n", "", $data[2]));
    }
    return $users;
}

function fetchUser($email) {
    return fetchUsers()[$email];
}

function registerNewUser($data) {

    $users = fetchUsers();
    $userNotExist = true;

    if (isset($users[$data['email']])) {
        $userNotExist = false;
    }


    if ($userNotExist) {
        $userInformation = array(
            $data['name'],
            $data['email'],
            $data['password'],
        );
        $record = implode(';', $userInformation) . "\r\n";
        file_put_contents(DATABASE_FILE_NAME, $record, FILE_APPEND);
        return array('success' => $userNotExist, 'message' => 'Uživatel úspěšně vytvořen');
    }

    return array('success' => $userNotExist, 'message' => 'Uživatel již existuje');
}

function authenticate($data) {
    $user = fetchUser($data['email']);
    if (isset($user)) {
        if ($user['password'] == $data['password']) {
            return true;
        }
    }
    return false;
}

function sendMail($recipient, $subject, $message) {
    mail(
        $recipient,
        $subject,
        $message,
        array(
            'MIME-Version: 1.0',
            'Content-type: text/html, charset=utf-8',
            'From: app@reglog.com',
            'Reply-Tp: app@reglog.com',
            'X-Mailer: PHP/8.0',
        )
    );
}

