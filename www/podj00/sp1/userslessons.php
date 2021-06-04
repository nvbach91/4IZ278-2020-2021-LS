<?php require __DIR__ . '/includes/head.php'; ?>
<?php require __DIR__ . '/includes/navbar.php'; ?>
<?php require_once __DIR__ . '/database/repositories/LessonRepository.php'; ?>
<?php

$repo = new LessonRepository();

$users_lessons = $repo->getLessonsForAllUsers();

function getAllUsersByLessonId($id){
    $repo = new LessonRepository();
    return $repo->getUsersByLessonId($id);
}


$user = null;
$userDb = new UsersRepository();
if (isset($_SESSION['fb_access_token'])) {
    $user = $userDb->getUserByFacebookId($_SESSION['user_facebook_id']);
} else if (isset($_SESSION['logged_user'])) {
    $user = $userDb->getUser($_SESSION['logged_user']);
}

if($user[0]["privilege"] < 3){
    header('Location: index');
    exit();
}



?>
    <main class="container-fluid" id="mainCoaches">
        <div class="row justify-content-md-center">
            <div class="col-md-9">
                <div class="row">
                    <?php foreach ($users_lessons as $row) : ?>
                        <div class="col-md-4 text-center">
                            <div class="card mb-3 cart-card mylecturesCard" style="min-height: 220px">
                                <div class="row p-4">
                                    <div class="col-md-2">
                                        <img src="<?php echo htmlspecialchars($row["gym_logo"])?>" alt="logo" class="gymLogoImg p-2">
                                    </div>
                                    <div class="col-md-10">
                                        <h2>
                                            <?php echo htmlspecialchars($row["lesson_name"]) ?></h2>
                                    </div>
                                </div>
                                <hr>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-10 pb-2">
                                        <?php foreach (getAllUsersByLessonId($row["lesson_id"]) as $item) :?>
                                        <h4><?php echo $item["username"]?></h4>
                                        <?php endforeach; ?>
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