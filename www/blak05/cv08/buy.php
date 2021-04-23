<?php require __DIR__ . '/db.php' ?>
<?php 
    session_start();


    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    $id = $_GET['id'];
    //$offset = $_GET[]
    
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
?>
