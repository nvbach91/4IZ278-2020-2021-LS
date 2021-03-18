<?php
include './logic/logic_fetch.php'; 
include './logic/logic_error.php'; 
$invalidInputs = [];
$isSubmitted = !empty($_POST);
if($isSubmitted) {
    $name = htmlspecialchars(trim(($_POST['name'])));
    $email = htmlspecialchars(trim(($_POST['email'])));
    $password = htmlspecialchars(trim(($_POST['password'])));
    $approve_password = htmlspecialchars(trim(($_POST['approve_password'])));
        
        if (!$name) {
            array_push($invalidInputs, 'Není zadané jméno');
        }
        if (!$email) {
            array_push($invalidInputs, 'Není zadaný email');
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($invalidInputs,'Email není validní');
        }
        if (!$password) {
            array_push($invalidInputs, 'Není zadané heslo');
         }elseif (strlen($password) <6  ) {
            array_push($invalidInputs, 'Heslo je příliš krátké');
        } elseif ($password !== $approve_password) {
            array_push($invalidInputs, 'Heslo není stejné');
        }
        if(empty($invalidInputs)){
            //provest presmerovani
           $registrationResult = registerNewUser($email,$name,$password);
           if ($registrationResult === 'Succes') {
            sendEmail($email,"registration","your name: $name");
            header("location: login.php?email=$email");
           }else{
            array_push($invalidInputs, $registrationResult);
           }
        }
    }

function sendEmail($recipient, $subject, $message) {
    $header = [
        'MIME-Version: 1.0',
        'Content-type: text/html, charset=utf-8',
        'From: app@dev.com',
        'Reply-To: app@dev.com',
        'X-Mailer: PHP/8.0',
        ];
    $body = "
        <h1>$subject</h1>
        <p>$message</p>
    ";
    $mailResult = mail($recipient, $subject, $body, implode("\r\n", $header));
    return $mailResult;
    }

function registerNewUser($email,$name,$password){
  if(fetchUser($email)== false){
    $databaseFileName = getcwd().'/databases/users.db';
    file_put_contents($databaseFileName,"$email;$name;$password"."\r\n",FILE_APPEND);
    return 'Succes';
    }else{
    return "Email already in use";
  }
}


?>