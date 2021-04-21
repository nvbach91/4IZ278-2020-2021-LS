<?php
    require __DIR__ . '/user-required.php';
    require __DIR__ . '/includes/header.php'; 
?>

<main class="container">
    <h1 class="text-center">Profile</h1>
    <hr>
    <div class="col-md-5">
        <h4>User: <?php echo @$_SESSION['user_email']; ?></h4>
    </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>