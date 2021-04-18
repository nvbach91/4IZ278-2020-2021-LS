<?php require __DIR__ . '/db.php' ?>
<?php require __DIR__ . '/auth.php' ?>
<?php 
    session_start();
    if (@$_SESSION['username'] == null){
        header('Location: login.php?mgs=1');
    }else{
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
        $id = $_GET['id'];
        
        $sql = "SELECT * FROM goods WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        $goods = $statement->fetch();

        if(!$goods){
            header('Location:index.php');
            exit();
        }

        if(in_array($id,$_SESSION['cart'])){
            $_SESSION['cart'][] = $id;
        }

        $_SESSION['cart'][] = $id;
        header('Location: cart.php');
    }
?>
