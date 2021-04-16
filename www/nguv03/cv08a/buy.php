<?php require __DIR__ . '/db.php' ?>
<?php 
    session_start();
    
    $offset = $_GET['offset'];
    $_SESSION['offset'] = $offset;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM goods WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
    $goods = $statement->fetchAll();

    if (!$goods) {
        header('Location: 404.php');
        exit();
    }
    if (!in_array($id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $id;
    }
    header('Location: cart.php');
?>