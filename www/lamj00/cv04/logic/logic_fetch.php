<?php


function fetchUsers()
{
  $databaseFileName = getcwd().'/databases/users.db';
  $lines = file($databaseFileName);
  $users = [];
  foreach ($lines as $line) {
    $fields = explode(';', $line);
    $user = [
        'email' =>  trim($fields[0]),
        'name' =>  trim($fields[1]),
        'password' => trim($fields[2]),
    ];
    array_push($users,$user);
  }
  return $users;
}
function fetchUser($email){
    $users =fetchUsers();
  foreach($users as $user){
    if($user['email'] === $email){
        
      return $user;
    }
  }
  return false;
}


?>