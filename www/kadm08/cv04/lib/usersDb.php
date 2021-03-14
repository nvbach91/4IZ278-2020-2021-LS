<?php 

function fetchUsers() {
    $users = [];
    $databaseFileName = __DIR__ . '/../database/users.db';

    $userRecords = file($databaseFileName);

    foreach ($userRecords as $userRecords) {
        $userRecords = trim($userRecords);
        if (!$userRecords) continue; 
        $fields = explode(";", $userRecords);
        $users[$fields[1]] = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];
    }
    return $users;
}

function fetchUser($email) {
    $users = fetchUsers();
    
    if (array_key_exists($email, $users)) {
        return $users[$email];
    }
    return null;
}

function addUser($user) {
    $databaseFileName = __DIR__ . '/../database/users.db';
    $newRecord = implode(';', $user) . "\r\n";
    
    file_put_contents($databaseFileName, $newRecord, FILE_APPEND);
}

function emailExists($email) {
    $users = fetchUsers();

    return array_key_exists($email, $users);
}

?>