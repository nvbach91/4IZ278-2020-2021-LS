<?php

function fetchUsers(){
    $users = [];
    $lines = file(__DIR__ . '/../user.db');

    foreach($lines as $line)
    {
        $line = trim($line);
        $fetch = explode(',',$line);
        $users[$fetch[1]] = [
            'username' => $fetch[0],
            'email' => $fetch[1],
            'password' => $fetch[2]
        ];
    }

    return $users;
}

function fetchUser($email){

    $users = fetchUsers();
    foreach($users as $user){
        if($email == $user['email']){
            return $user;
        }
    }

    return null;
}
?>