<?php

require __DIR__ . '/../utils/utils.php';

$users = getUsers();

?>


<?php include __DIR__ . '/../includes/header.php'?>

<main class="container">
    <h1 class="text-center">Registered Users</h1>
        <?php foreach($users as $user): ?>
            <div class="row justify-content-center">
                <div class="col-md-5 border border-white bg-dark">
                    <h4 class="text-center text-info"><?php echo strtoupper($user['name']); ?></h5>
                    <div class="divider" style="margin-top: 0;"></div>
                    <p class="text-muted">Contact information:</p>
                    <div class="d-flex justify-content-between">
                        <span>Email:</span>
                        <span><?php echo $user['email']?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Github profile:</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Website:</span>
                    </div>
                </div>
            </div>
            <br>
        <?php endforeach; ?>
</main>

<?php include __DIR__ . '/../includes/footer.php'?>