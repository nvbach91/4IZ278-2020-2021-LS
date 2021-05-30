<?php require __DIR__ . '/includes/head.php'; ?>
<?php require __DIR__ . '/includes/navbar.php'; ?>
<?php require __DIR__ . '/database/repositories/LessonRepository.php' ?>
<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/facebook/config.php';
require_once __DIR__ . '/utils/utils.php';

if (session_status() != 2) {
    session_start();
}

//kdyby to někdo zkusil hardlinkem
if (!isset($_SESSION["user_facebook_id"]) && !isset($_SESSION['logged_user'])) {
    header('Location: login');
}

$id = isset($_SESSION["user_facebook_id"]) ? $_SESSION["user_facebook_id"] : null;

$loggedUser = isset($_SESSION['logged_user']) ? $_SESSION['logged_user'] : null;

if (isset($loggedUser) || isset($id)) {
    $lessonDb = new LessonRepository();
    $myLessons = $lessonDb->getLessonsForUser($loggedUser, $id);
}


?>
    <main class="container-fluid" id="mainMyLessons">
        <div class="row justify-content-md-center">
            <div class="col-md-9">
                <div class="row">
                    <?php foreach (@$myLessons as $row) : ?>
                        <div class="col-md-4 text-center">
                            <div class="card mb-3 cart-card mylecturesCard">
                                <div class="row p-2">
                                    <h2 class="lessonName"><?php echo htmlspecialchars($row["lesson_name"]) ?></h2>
                                </div>
                                <div class="row p-2 floatLeft">
                                    <div class="col-md-3">
                                        <h5 title="Gym"><i
                                                    class="fas fa-building"></i> <?php echo htmlspecialchars($row["gym_name"]) ?>
                                        </h5>
                                    </div>
                                    <div class="col-md-9">
                                        <h5 title="Trenér"><i
                                                    class="fas fa-user-tie"></i> <?php echo htmlspecialchars($row["first_name"]) . " " . htmlspecialchars($row["last_name"]) ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-md-6">
                                        <h5 title="Den"><i
                                                    class="far fa-calendar-alt"></i> <?php echo getCzechDate(date('d. M', strtotime($row["date_from"]))) ?>
                                        </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 title="Čas"><i
                                                    class="fas fa-clock"></i> <?php echo date('H', strtotime($row["date_from"])) . "-" . date('H', strtotime($row["date_to"])) ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-md-6">
                                        <h5 title="Cena"><i
                                                    class="fas fa-money-bill-wave"></i> <?php echo htmlspecialchars($row["price"]) . " CZK" ?>
                                        </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 title="Kapacita"><i
                                                    class="fas fa-balance-scale"></i> <?php echo htmlspecialchars($row["filled_capacity"]) . " / " . htmlspecialchars($row["total_capacity"]) ?>
                                        </h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row pb-2 justify-content-md-center">
                                    <div class="col-md-10">
                                        <a class="btn btn-outline-warning w-75"
                                           href='utils/removeLesson.php?lessonId=<?php echo htmlspecialchars($row['lesson_id'], ENT_QUOTES, 'UTF-8'); ?>'>Odhlásit</a>
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