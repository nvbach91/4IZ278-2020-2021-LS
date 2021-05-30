<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../database/repositories/UsersRepository.php';


function sendEmail($recipient, $subject)
{
    global $emailTemplates;
    $headers = implode("\r\n", $emailTemplates['headers']);
    $message = $emailTemplates[$subject]($recipient);
    return mail($recipient, $subject, $message, $headers);
}

function findAllWithSameEmail($objects, $email)
{
    return !empty(array_filter($objects, function ($toCheck) use ($email) {
        return $toCheck["email"] == $email;
    }));
}

function findAllWithSameUsername($objects, $username)
{
    return !empty(array_filter($objects, function ($toCheck) use ($username) {
        return $toCheck["username"] == $username;
    }));
}

function findAllWithSameFacebookId($objects, $facebookId)
{
    return !empty(array_filter($objects, function ($toCheck) use ($facebookId) {
        return $toCheck["facebook_id"] == $facebookId;
    }));
}


function registerNewUser($payload, $isFacebook)
{
    $userDb = new UsersRepository();
    $users = $userDb->fetchAll();
    $password = $payload["password"];
    $hashed_password = null;
    if (!$isFacebook) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    }
    $userRecord = [
        "username" => $payload['name'],
        "email" => $payload['email'],
        "password" => $hashed_password,
        "facebook_id" => isset($payload['facebook_id']) ? $payload['facebook_id'] : null
    ];

    if (!$isFacebook) {
        if (findAllWithSameEmail($users, $payload['email'])) {
            return ['success' => false, 'msg' => 'Tento email je již zaregistrován'];
        }
        if (findAllWithSameUsername($users, $payload['name'])) {
            return ['success' => false, 'msg' => 'Uživatelské jméno je již obsazené'];
        }
    } else {
        if (findAllWithSameFacebookId($users, $payload['facebook_id'])) {
            return;
        }
    }

    var_dump($userRecord);
    $userDb->createUser($userRecord);
    return ['success' => true, 'msg' => 'Registrace proběhla úspešně'];
}

;


function authenticate($username, $password)
{
    $userDb = new UsersRepository();
    $user = $userDb->getUser($username);
    if (!$user) {
        return ['success' => false, 'msg' => 'Účet neexistuje'];
    }
    $hashed_password = $user[0]["password"];
    if (password_verify($password, $hashed_password)) {
        return ['success' => false, 'msg' => 'Špatné heslo'];
    }
    return ['success' => true, 'msg' => 'Login success'];
}

;

function getInputValidClass($key, $errors)
{
    return array_key_exists($key, $errors) ? ' is-invalid' : '';
}

function getCzechDate($date)
{
    $men = [
        'January', 'February', 'March', 'April', 'May',
        'Jun', 'July', 'August', 'September', 'October',
        'November', 'December'
    ];

    $mcz = [
        'ledna', 'února', 'března', 'dubna', 'května',
        'června', 'července', 'srpna', 'září', 'října',
        'listopadu', 'prosince'
    ];

    $date = str_replace($men, $mcz, $date);

    $den = [
        'Monday', 'Tuesday', 'Wednesday', 'Thursday',
        'Friday', 'Saturday', 'Sunday'
    ];

    $dcz = [
        'Pondělí', 'Úterý', 'Středa', 'Čtvrtek',
        'Pátek', 'Sobota', 'Neděle'
    ];

    return str_replace($den, $dcz, $date);
}

?>
