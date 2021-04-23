<?php
session_start();
if (@$_SESSION['username'] == null){
    header("Location: login.php");
}else{
    $user = @$_SESSION['username'];
    $sql = "SELECT * FROM users WHERE email = :email";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $user]);
    $user = $statement->fetch(); 
    
    if($user['privilege'] == 2) {
        setcookie('privilege', 2, time() + 3600);
    }
}
?>