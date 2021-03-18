<?php
include './logic/logic_fetch.php'; 
include './logic/logic_error.php'; 
$invalidInputs = [];
$isSubmitted = !empty($_POST);
if($isSubmitted) {
    $email = htmlspecialchars(trim(($_POST['email'])));
    $password = htmlspecialchars(trim(($_POST['password'])));

    if (!$email) {
        array_push($invalidInputs, 'Není zadaný email');
    }
    if (!$password) {
        array_push($invalidInputs, 'Není zadané heslo');
    }
    if(empty($invalidInputs)){
       $result = loginUser($email,$password);
       if($result === null){
         array_push($invalidInputs, 'Wrong credentials');
       } else { 
           
          header("location: profile.php?email=$email");
       }
    }
}
function loginUser($email,$password){
    $user = fetchUser($email);
 
    if($user['email'] === $email and $user['password'] === $password){
        return $user;
    }else{
        return null;
    }
    
}
?>
