<?php
  require __DIR__ . "/../../utils/utils.php";
  $pageTitle = "Users";
?>
<?php require __DIR__ . '/../../components/header.inc.php'; ?>
<?php
  $users = fetchUsers();
?>
<?php foreach ($users as $user): ?>
    <p>
        <h2>
            <?php echo $user['first_name'] . " " . $user['last_name'] ?>
        </h2>
    </p>
<?php endforeach; ?>

<?php require __DIR__ . '/../../components/footer.inc.php'; ?>
