<?php require __DIR__ . '/db.php'; ?>
<?php 

    session_start();


    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['offset'] = $_GET['offset'];

    $id = $_GET['id'];
    $sql = "SELECT * FROM goods WHERE id = :id;";
    
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
    $goods = $statement->fetchAll();

    if (!$goods) {
        header('Location: 404.php');
        exit();
    }

    if (!in_array($id, $_SESSION['cart'])) {
        array_push($_SESSION['cart'], $id);
    }
    header('Location: cart.php');

?>