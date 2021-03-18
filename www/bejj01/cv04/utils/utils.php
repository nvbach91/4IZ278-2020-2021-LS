<?php

define('USERS_FILE', dirname(__DIR__) . "/database/users.db");

function getInvalidClass($key, $array) {
    return key_exists($key, $array) ? ' is-invalid' : '';
}

function makeRegistration($data) {
    $users = getUsers();

    if (key_exists($data['email'], $users)) {
        return [
            'success' => false,
            'message' => 'User with this email address already exists.'
        ];
    }

    $userInfo = [
        $data['name'],
        $data['email'],
        $data['password']
    ];

    $newRecord = implode(';', $userInfo) . "\r\n";
    //vlozeni do souboru
    file_put_contents(USERS_FILE, $newRecord, FILE_APPEND); 

    return [
        'success' => true,
        'message' => ''
    ];
}

function sendConfirmationMail($recipient, $subject, $message) {
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html, charset=utf-8',
        'From: mypage@dev.com',
        'Reply-To: mypage@dev.com',
        'X-Mailer: PHP/'.phpversion()
    ];

    $msg = "
        <h1>Registration confirmation<h1>
        <p>$message</p>
    ";

    return mail($recipient, $subject, $msg, implode("\r\n", $headers));
}

function getUsers() {
    $users = [];
    $records = file(USERS_FILE);

    foreach ($records as $record) {
        $record = trim($record);

        if (!$record) {
            continue;
        }

        $fields = explode(';', $record);

        // users with email as a key
        $users[$fields[1]] = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2]
        ];
    }

    return $users;
}

function getUser($email) {
    $records = file(USERS_FILE);

    foreach ($records as $record) {
        $record = trim($record);
        if (!$record) {
            continue;
        }

        $fields = explode(';', $record);
        if ($fields[1] === $email) {
            // user found
            return [
                'name' => $fields[0],
                'email' => $fields[1],
                'password' => $fields[2]
            ];
        }
    }

    // user not found
    return null;
}

function authenticateUser($email, $password) {
    $user = getUser($email);

    // user not found
    if (!$user) {
        return [
            'success' => false,
            'message' => 'Account with this email does not exist.'
        ];
    }

    // wrong password entered
    if ($password !== $user['password']) {
        return [
            'success' => false,
            'message' => 'Incorrect password.'
        ];
    }

    // successful login
    return [
        'success' => true,
        'message' => 'You have been successfully logged in.'
    ];
}

?>