<?php 

function findUser($email)
{
    $databaseFileName = __DIR__ . '/database/users.db';
    $lines = file($databaseFileName);
    foreach ($lines as $line) {
        $line = trim($line);
        $fields = explode(';', $line);
        if ($fields[1] === $email) {
            return [
                'name' => $fields[0],
                'email' => $fields[1],
                'password' => $fields[2],
            ];
        }
    }
    return null;
};

function sendEmail($recipient, $subject, $message) {
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html, charset=utf-8',
        'From: mart10@vse.cz',
        'Reply-To: mart10@vse.cz',
        'X-Mailer: PHP/8.0',
    ];
    $msg = "
        <h1>Registration confirmation</h1>
        <p>$message</p>
    ";
    $mailResult = mail($recipient, $subject, $msg, implode("\r\n", $headers));
    return $mailResult;
}

function findUsers() {
    $users = [];
    $databaseFileName = __DIR__ . '/database/users.db';
    $lines = file($databaseFileName);
    foreach ($lines as $line) {
        $line = trim($line);
        $fields = explode(';', $line);
        $users[$fields[1]] = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];
    }
    return $users;
};

function authenticate($email, $password) {
    $user = findUser($email);
    if (!$user) {
        return ['success' => false, 'msg' => 'User not found'];
    }
    if ($user['password'] !== $password) {
        return ['success' => false, 'msg' => 'Password is not correct'];
    }
    return ['success' => true, 'msg' => 'You have successfuly logged in'];
};

?> 