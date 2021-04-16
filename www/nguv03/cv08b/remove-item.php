<?php require __DIR__ . '/db.php'; ?>
<?php 
    session_start();
    
    $id = $_GET['id'];

    if (in_array($id, $_SESSION['cart'])) {
        $index = array_search($id, $_SESSION['cart']);
        unset($_SESSION['cart'][$index]);
    }

    header('Location: cart.php');
?>

<?php

    // $sessions = [
    //     'lef36ggch0ekn8hk24v6l9m1pd' => [
    //         'cart' => [3, 4, 1, 2]
    //     ],
    //     'asd' => [],
    //     'qwe' => [],
    //     'qweeqwe' => [],
    //     'asd' => [],
    // ];

?>