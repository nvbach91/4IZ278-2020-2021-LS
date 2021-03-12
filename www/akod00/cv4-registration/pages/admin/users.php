<?php
  require __DIR__ . "/../../utils/utils.php";
  $pageTitle = "Users";
?>
<?php require __DIR__ . '/../../components/header.inc.php'; ?>
<?php
  $users = fetchUsers();
?>
<h1>Hey this is super secret, pwease don't leak our user data (⊙_⊙;)</h1>

<?php foreach ($users as $user): ?>
    <p>
        <h2>
            <?php echo $user['first_name'] . " " . $user['last_name'] ?>
        </h2>

        <p>
          Cards: <?php echo $user['card_pack']?>
        </p>
    </p>
<?php endforeach; ?>

<?php require __DIR__ . '/../../components/footer.inc.php'; ?>
