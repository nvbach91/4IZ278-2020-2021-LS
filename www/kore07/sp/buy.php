<?php require_once __DIR__ . '/database/ProductsDB.php'; ?>
<?php
    session_start();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }


    $productsDB = new ProductsDB();
    $products = $productsDB->fetchBy('product_id', $_GET['id']);

    $productsInfo = array(
        'id' => $products['product_id'],
        'qnt' => $products['product_quantity'],
    );

    if (!$products) {
        exit('Unable to find products!');
    }

    if ($_SESSION['cart'] !== []) {
        foreach ($_SESSION['cart'] as $key=>$value) {
            if ($_SESSION['cart'][$key]['id'] === $products['product_id']) {
                $_SESSION['cart'][$key]['qnt'] = $_SESSION['cart'][$key]['qnt'] + 1;

                $sets = array(
                    'product_quantity' => $_SESSION['cart'][$key]['qnt'],
                );

                $wheres = array(
                    'product_id' => $_SESSION['cart'][$key]['id'],
                ); 

                $productsDB->updateBy($wheres, $sets);
            } else {
                $_SESSION['cart'][] = $productsInfo;
            }
        }
    } else {
        $_SESSION['cart'][] = $productsInfo;
    }

    header('Location: cart.php');
?>
