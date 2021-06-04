<?php require __DIR__ . '/includes/head.php'; ?>
<?php require __DIR__ . '/includes/navbar.php'; ?>
<?php require_once __DIR__ . '/database/repositories/GymRepository.php'; ?>
<?php

$gymDb = new GymRepository();

$allGyms = $gymDb->fetchAll();

function getLecturesHref($row){
    return "lectures?lectures=" . $row;
}

?>
    <main class="container-fluid" id="mainGyms">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <?php foreach ($allGyms as $row) : ?>
                    <div class="card mb-3 cart-card mylecturesCard">
                        <div class="row p-5 pt-2">
                            <div class="col-md-5">
                                <h4><?php echo htmlspecialchars($row["gym_name"]) ?></h4>
                                <img src="<?php echo htmlspecialchars($row["photo"]) ?>" width="400px">
                            </div>
                            <div class="col-md-7 pt-5">
                                <div class="row">
                                     <span>
                                        <?php echo htmlspecialchars($row["description"]) ?>
                                     </span>
                                </div>
                                <div class="row">
                                    <a class="gymHref"
                                       href="<?php echo htmlspecialchars(getLecturesHref(htmlspecialchars($row["gym_name"]))) ?>">
                                        <div class="nav-item availableLessons">
                                            <div class="dropdown-item">
                                                Dostupné lekce <i class="fas fa-location-arrow"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

<?php include __DIR__ . '/includes/foot.php' ?>