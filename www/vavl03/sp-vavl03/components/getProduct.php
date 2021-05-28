<?php require __DIR__ . '/../db/ProductsDB.php'; ?>
<?php
header("Content-Type:application/json");
// first update pieces of product in session cart
session_start();
foreach ($_SESSION['productsToShow'] as $product) {
    if ($_GET['productName'] === $product['product_name']) {
        $productIdToUpdate = $product['product_id'];
    }
}
$newPcs = $_GET['productPcs'];
$_SESSION['cart'][$productIdToUpdate] = $newPcs; // update pcs for corresponding product id in cart

// then return updated product price
if (!empty($_GET['productName'])) {
    $productName = $_GET['productName'];
    $productsDB = new ProductsDB();
    $price = $productsDB->fetchProductPrice($productName);
    if (empty($price)) {
        response(200, "Price Not Found", NULL);
    } else {
        return response(200, "Price found", $price);
    }
} else {
    response(400, "Invalid Request", NULL);
}

function response($status, $status_message, $data)
{
    header("HTTP/1.1 " . $status);

    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;

    $json_response = json_encode($response);
    echo $json_response;
}

?>
