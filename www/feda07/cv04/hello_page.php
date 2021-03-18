<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/navigation.php'; ?>
<main class="card-account">
    <h1>Account page</h1>
    <div><br>
    <img src="images/hello.png" alt="hello">
    </div>
    <br>
    <h2> <?php  echo 'WELCOME,' . $_GET['name'] ?></h2>
</main>
<?php include __DIR__ . '/includes/foot.php'; ?>
