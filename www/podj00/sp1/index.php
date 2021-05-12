<?php require __DIR__ . '/includes/head.php'; ?>
<?php require __DIR__ . '/includes/navbar.php'; ?>
<?php

require './database/db.php';

/*
$nItemsPerPagination = 4;

# offset pro strankovani
if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}

# celkovy pocet zbozi pro strankovani
//$count = $db->query("SELECT COUNT(id) FROM goods")->fetchColumn();

$users = new UsersRepository();

//$users->create("");

$stmt = $db->prepare("SELECT * FROM goods ORDER BY id DESC LIMIT $nItemsPerPagination OFFSET ?");
$stmt->bindValue(1, $offset, PDO::PARAM_INT);
$stmt->execute();
$goods = $stmt->fetchAll(); */

?>
<main class="container">

</main>

<?php include __DIR__ . '/includes/foot.php' ?>