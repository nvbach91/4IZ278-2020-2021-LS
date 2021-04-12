<?php

function fetchUsers()
{
    $users = [];
    $databaseFileName = __DIR__ . '/../db/users.db';

    $userRecords = file($databaseFileName);

    foreach ($userRecords as $userRecord) {
        $userRecord = trim($userRecord);
        if (!$userRecord) continue;
        $fields = explode(";", $userRecord);
        $users[$fields[1]] = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];
    }
    return $users;
}

function fetchUser($email)
{
    $users = fetchUsers();

    if (array_key_exists($email, $users)) {
        return $users[$email];
    }
    return null;
}
 ?>