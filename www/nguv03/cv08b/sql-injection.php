<?php 

if (!empty($_GET)) {
    $maxPrice = $_GET['maxPrice'];
} else {
    $maxPrice = 100000;
}

$pdo = new PDO(
    "mysql:host=localhost;dbname=test;charset=utf8mb4",
    "root",
    ""
);

$sql = "SELECT * FROM goods WHERE price < :maxPrice;";

// 0; DROP TABLE goods; --
// "SELECT * FROM goods WHERE price < $maxPrice;qweqweqw"
// "SELECT * FROM goods WHERE price <  0; DROP TABLE goods; --;qweqweqw"

$statement = $pdo->prepare($sql);
$statement->bindValue('maxPrice', $maxPrice);
$statement->execute();

$goods = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>SQL injection</h1>
    <form action="." method="GET">
        <label>maxPrice:</label>
        <input name="maxPrice">
        <button>Submit</button>
    </form>
    <pre>
        <?php var_dump($goods); ?>
    </pre>
</body>
</html>