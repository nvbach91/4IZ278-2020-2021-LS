<?php require __DIR__ . '/database_connection.php'; ?>

<?php

if(isset($_POST['registration'])){
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $univesity =$_POST['university'];
    $dormitory = $_POST['dormitory'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    /*$sql = "SELECT email FROM user where email = '$email'";
    $e = $pdo->prepare($sql);
    $e->execute();
    $results = $e->fetchAll();
    $e = $e[0]['email'];
    */

    if( $password  == $confirm){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (name, surname, id_university, id_dormitory, username, phone, email, password)  
        VALUES (?,?,?,?,?,?,?,?)";
         $statement = $pdo->prepare($sql);
         $statement->execute([$name,$surname,$univesity,$dormitory,$username,$phone,$email ,$hash]);
         header('Location: login.php');
    }else{
        header('Location: registration.php');
    }
}
/*
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT password FROM user where email = '$email'";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();
    $hash = $results[0]['password'];
    if (password_verify($password, $hash)) {    
         header('Location: index.php');
    }else{
        header('Location: login.php');
    }
}
*/

?>