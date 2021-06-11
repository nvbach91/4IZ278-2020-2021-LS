<?php 
    session_start();
    if (@$_SESSION['user'] == null){
        header('Location: login.php?msg=1');
    }else{
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
        $id = $_GET['id'];

       // if(in_array($id,$_SESSION['cart'])){
       //     $_SESSION['cart'][] = $id;
       // }

        $_SESSION['cart'][] = $id;
        header('Location: cart.php');
    }
?>