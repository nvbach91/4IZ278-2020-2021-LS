<?php require __DIR__ . '/includes/head.php'; ?>
<?php require __DIR__ . '/includes/navbar.php'; ?>
<?php require_once __DIR__ . '/database/repositories/CoachRepository.php'; ?>
<?php

$repo = new CoachRepository();

$allCoaches = $repo->fetchAll();


?>
    <main class="container-fluid" id="mainCoaches">
        <div class="row justify-content-md-center">
            <div class="col-md-9">
                <div class="row">
                    <?php foreach ($allCoaches as $row) : ?>
                        <div class="col-md-4 text-center">
                            <div class="card mb-3 cart-card mylecturesCard">
                                <div class="row p-2">
                                    <h4><?php echo htmlspecialchars($row["first_name"]) . " " . htmlspecialchars($row["last_name"]) ?></h4>
                                    <img src="<?php echo $row["picture"] ?>" width="400px">
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-5 pb-2">
                                        <a class="colorBlack marginRightFacebook"
                                           href="<?php echo htmlspecialchars($row["facebook_url"]) ?>"
                                           target="_blank"><i class="fab fa-facebook-f"></i></a>
                                        <a class="colorBlack"
                                           href="<?php echo htmlspecialchars($row["instagram_url"]) ?>" target="_blank"><i
                                                    class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>

<?php include __DIR__ . '/includes/foot.php' ?>