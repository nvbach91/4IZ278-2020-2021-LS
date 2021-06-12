<?php require __DIR__ . '/db/connection.php'; ?>
<?
$offset = 0;

if(!empty($_GET)) {
    $offset = $_GET['offset'];
} 

$nItemsPerPagination = 4;

$nItemsInDatabase = $pdo->query("SELECT COUNT(id) FROM ramen;")->fetchColumn();
$nPaginations = ceil($nItemsInDatabase / $nItemsPerPagination);

$sql = "SELECT * FROM ramen WHERE 1 LIMIT $nItemsPerPagination OFFSET ?;";

$statement = $pdo->prepare($sql);
$statement->bindValue(1, $offset, PDO::PARAM_INT);
$statement->execute();

$ramen = $statement->fetchAll(PDO::FETCH_ASSOC);
?>