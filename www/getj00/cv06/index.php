
<?php
const TD = '</td><td>';
const MAXPRICE = 10000;

// is local to the server this is running on
$pdo=new PDO('mysql:host=localhost;dbname=test;charset=utf8mb4', 'getj00', 'xxx');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$sql1 = "SELECT * from products WHERE price <= :maxPrice";
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute(['maxPrice' => isset($_GET['budget']) ? $_GET['budget'] : MAXPRICE]);

$sql2 = "SELECT * from products_eshop WHERE price <= :maxPrice";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute(['maxPrice' => isset($_GET['budget']) ? $_GET['budget'] : MAXPRICE]);

$sql3 = "SELECT name FROM categories_eshop WHERE category_id = :catid";
$stmt3 = $pdo->prepare($sql3);

/*
products:
product_id, name, img, price

products_eshop:
products_id, name, price, img, description, category

categories:
category_id, name, number

categories_eshop:
category_id, name
*/

?>

<?php include '_header.php'; ?>

<h1> Some games </h1>

<table>
<thead> <tr> <td>Cover Image</td> <td>Name</td> <td>Product ID</td> <td>Price</td> </tr></thead>
<?php

foreach ($stmt1->fetchAll() as $row){
    echo '<tr>';
    echo '<td> <img href="' . $row['img'] . '">'. TD . $row['name'] . TD . $row['product_id'] . TD . $row['price'] . '</td>';
    echo '</tr>';
}

?>
</table>

<br><br><br>

<h1> Some archery supplies </h1>
<br><p align="center">

<?php

$sql4 = "SELECT name FROM categories_eshop";
$stmt4 = $pdo->prepare($sql4);
$stmt4->execute();
echo 'Categories:<br> * ';
foreach($stmt4->fetchAll() as $row){
    echo '<a href="#">' . $row['name'] . '</a> * ';
}

?>
</p>
<br>
<form align="center" width="320px">
    <label for="Budget" class="form-label">Budget (0 ~ 10000):</label>
    <input name="budget" type="number" class="form-control" min="0" max="10000" step="100" id="Budget" value="<?php isset($budget) ? $budget : MAXPRICE; ?>" defaultValue="<?= MAXPRICE ?>"/>
    <button type="register" class="btn btn-primary">Filter</button>
</form>
<br>
<table>
<thead><tr> <td>Cover Image</td> <td>Name</td> <td>Description</td> <td>Product ID</td> <td>Category</td> <td>Price</td> </tr></thead>

<?php

foreach ($stmt2->fetchAll() as $row){
    $stmt3->execute(['catid' => $row['category']]);
    $catName = $stmt3->fetchAll()[0]['name'];
    echo '<tr>';
    echo '<td> <img href="' . $row['img'] . '">' . TD . $row['name'] . TD . $row['description'] . TD . $row['products_id'] . TD . $catName . TD . $row['price'] . '</td>';
    echo '</tr>';
}

?>
</table>

<?php include '_footer.php'; ?>


