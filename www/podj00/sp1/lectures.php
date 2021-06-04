<?php require __DIR__ . '/includes/head.php'; ?>
<?php require __DIR__ . '/includes/navbar.php'; ?>
<?php require __DIR__ . '/database/repositories/LessonRepository.php' ?>
<?php require __DIR__ . '/database/repositories/GymRepository.php' ?>
<?php
require_once __DIR__ . '/utils/utils.php';

//Databáze
$lessonsDb = new LessonRepository();
$gymDb = new GymRepository();

//URL PARAMS
$url = $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
parse_str(@$url_components['query'], $params);

//GYMS
$allGyms = $gymDb->fetchAll();

//USER_LESSONS
$id = isset($_SESSION["user_facebook_id"]) ? $_SESSION["user_facebook_id"] : null;
$loggedUser = isset($_SESSION['logged_user']) ? $_SESSION['logged_user'] : null;
$userLessons = $lessonsDb->getLessonsForUser($loggedUser, $id);

//ALLLESSONS
$lessons = [];
if (isset($params) && isset($params["lectures"]) && $params["lectures"] != "all") {
    $lessons = $lessonsDb->fetchAllByGymName($params["lectures"]);;
} else {
    $lessons = $lessonsDb->fetchAll();
}

function isUserRegistered($row, $userLessons)
{
    $response = false;
    foreach ($userLessons as $lesson) {
        if ($row["lesson_id"] === $lesson["lesson_id"]) {
            $response = true;
            break;
        }
    }
    return $response;
}

function isFullCapacity($row)
{
    if ($row["total_capacity"] == $row["filled_capacity"]) {
        return true;
    }
    return false;
}


?>
    <main class="container-fluid" id="mainLections">
        <div class="row mt-5 p-3 bg-white">
            <hr>
            <div class="col-md-2">
                Zvolené posilovny:
            </div>
            <div class="col-md-3">
                <form method="GET" action="">
                    <select name="lectures" class="form-select" aria-label="Default select example"
                            onchange="this.form.submit()">
                        <option value="all" <?php if (!isset($params["lectures"]) || $params["lectures"] == "all") echo "selected" ?>>
                            Všechny
                        </option>
                        <?php foreach ($allGyms as $gym) : ?>
                            <option <?php if (isset($params["lectures"]) && ($params["lectures"] === htmlspecialchars($gym["gym_name"]))) echo "selected" ?>
                                    value="<?php echo htmlspecialchars($gym["gym_name"]) ?>"><?php echo htmlspecialchars($gym["gym_name"]) ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
            <?php if (isset($params["lock"]) && $params["lock"] == "true") : ?>
                <div class="col-md-7 bg-red">
                    <h4 class="text-white">Někdo se stihl přihlásit před vámi, zkuste zvolit jinou lekci</h4>
                </div>
            <?php endif; ?>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="row">
                    <?php foreach ($lessons as $row) : ?>
                        <div class="col-md-4 text-center">
                            <div class="card mb-3 cart-card mylecturesCard">
                                <div class="row p-4">
                                    <div class="col-md-2">
                                        <img src="<?php echo htmlspecialchars($row["gym_logo"]) ?>" class="gymLogoImg p-2">
                                    </div>
                                    <div class="col-md-10">
                                        <h2>
                                            <?php echo htmlspecialchars($row["lesson_name"]) ?></h2>
                                    </div>
                                </div>
                                <div class="row p-2 floatLeft">
                                    <div class="col-md-6">
                                        <h5 title="Gym"><i
                                                    class="fas fa-building"></i> <?php echo htmlspecialchars($row["gym_name"]) ?>
                                        </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 title="Trenér"><i
                                                    class="fas fa-user-tie"></i> <?php echo htmlspecialchars($row["first_name"]) . " " . htmlspecialchars($row["last_name"]) ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-md-6">
                                        <h5 title="Den"><i
                                                    class="far fa-calendar-alt"></i> <?php echo getCzechDate(date('d. M', strtotime(htmlspecialchars($row["date_from"])))) ?>
                                        </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 title="Čas"><i
                                                    class="fas fa-clock"></i> <?php echo date('H', strtotime(htmlspecialchars($row["date_from"]))) . "-" . date('H', strtotime(htmlspecialchars($row["date_to"]))) ?>
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
                                <div class="row pb-3 justify-content-md-center">
                                    <div class="col-md-10">
                                        <?php if (isUserRegistered($row, $userLessons)) : ?>
                                            <a class="btn btn-outline-secondary w-75"
                                               href='mylectures'>Moje lekce <i class="fas fa-check"></i></a>
                                        <?php else : ?>
                                            <a class="btn btn-outline-secondary w-75 <?php echo isFullCapacity($row) ? "disabled" : ""; ?>"
                                               onclick="clickAndDisable(this);"
                                               href='utils/registerLesson.php?lectures=<?php echo isset($params["lectures"]) ? htmlspecialchars($params["lectures"], ENT_QUOTES, 'UTF-8') : "all"; ?>&lessonId=<?php echo htmlspecialchars($row['lesson_id'], ENT_QUOTES, 'UTF-8'); ?>'>Zaregistrovat</a>
                                        <?php endif; ?>
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