<?php
function fetchUsers()
{
    $databaseFileName = __DIR__ . '/../database/users.db';

    $userRecords = file($databaseFileName);

    $users = [];

    foreach ($userRecords as $userRecord) {
        if (!$userRecord) {
            continue;
        }
        $fields = explode(';', $userRecord);
        $user = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];
        array_push($users, $user);
    }

    return $users;
};
