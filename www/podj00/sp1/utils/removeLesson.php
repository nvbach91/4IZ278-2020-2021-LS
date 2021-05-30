<?php require __DIR__ . '/../database/repositories/LessonRepository.php' ?>
<?php require __DIR__ . '/../database/repositories/UsersRepository.php' ?>

<?php
if (session_status() != 2) {
    session_start();
}

$url = $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
parse_str(@$url_components['query'], $params);

$lessonDb = new LessonRepository();

$user = null;
$userDb = new UsersRepository();

if (isset($_SESSION['fb_access_token'])) {
    $user = $userDb->getUserByFacebookId($_SESSION['user_facebook_id']);
} else if (isset($_SESSION['logged_user'])) {
    $user = $userDb->getUser($_SESSION['logged_user']);
}

$lessonDb->removeLesson($user, $params["lessonId"]);

header('Location: ../mylectures');


?>