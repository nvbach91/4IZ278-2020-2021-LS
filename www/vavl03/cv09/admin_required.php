<?php

// php HTTP autentizace
// http://php.net/manual/en/features.http-auth.php
//require 'db.php';
/*
$stmt = $db->prepare('SELECT email,password,privileges FROM users');
$stmt->execute();
// nacte do promenne $user aktualne prihlaseneho usera, bude pristupny z cele aplikace
$valid_users = $stmt->fetchAll(); //vezmi prvni zaznam z db
//var_dump($valid_users);
$user = @$_SERVER['PHP_AUTH_USER'];
$password = @$_SERVER['PHP_AUTH_PW'];
$validated = false;
foreach ($valid_users as $valid_user){
    if(strcmp($valid_user['email'],$user) and
        strcmp($valid_user['password'],$password) and
        strcmp($valid_user['privileges'],"2"  ) and
        strcmp($valid_user['privileges'],"3"  )){
        $validated = true;
        //var_dump($validated) ;
    }
}
//var_dump($_SESSION);
*/
//var_dump($current_user['privileges']);
if ((int)$current_user['privileges'] < 2) {

    exit('Unauthorized');
}

?> 