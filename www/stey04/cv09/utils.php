<?php
$alert = '';
$invalidInputs = [];
$alertMessages = '';


function makeAlerts()
{
    global $alert, $invalidInputs, $alertMessages;

    $alert = 'alert-success';
    $success = "<h2>Form is submitted👍</h2>";
    $fail = '<h2>😔</h2>';

    if ($invalidInputs) {
        $alert = 'alert-danger';
        $alertMessages = $fail . implode('<br>', $invalidInputs);
    } else {
        $alertMessages = $success;
    }
}

function writeToDatabase($db, $data)
{
    return file_put_contents($db, $data, FILE_APPEND);
}

function makeRegistration($data)
{
    $name = $data['username'];
    $email = $data['email'];
    $password = $data['password'];
    $record = "$name;$email;$password\r\n";
    $databaseFileName = __DIR__ . '/database/users.db';

    if (exists($databaseFileName, $email)) {
        return null;
    }

    return writeToDatabase($databaseFileName, $record);
}

function exists($db, $attr)
{
    $records = file($db);
    foreach ($records as $r) {
        $f = explode(';', $r);
        if ($f[1] == $attr) {
            return [
                'name' => trim($f[0]),
                'email' => trim($f[1]),
                'password' => trim($f[2]),
            ];
        }
    }
    return null;
}

