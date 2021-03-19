<?php include './includes/header.php' ?>
<?php include './includes/navigation.php' ?>
<main>
    <h1>Homepage</h1>
    <?php if (@$_GET['ref'] === 'login'): ?>
            <div class="alert alert-success">You have successfully logged in!</div>
    <?php endif; ?>
</main>
<?php include './includes/footer.php' ?>