<?php require __DIR__ . '/../database/repositories/LessonRepository.php' ?>
<?php require __DIR__ . '/../database/repositories/UsersRepository.php' ?>

<?php

require __DIR__ . '/../utils/utils.php';

if (session_status() != 2) {
    session_start();
}

$url = $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
parse_str(@$url_components['query'], $params);

$user = null;
$userDb = new UsersRepository();

if (isset($_SESSION['fb_access_token'])) {
    $user = $userDb->getUserByFacebookId($_SESSION['user_facebook_id']);
} else if (isset($_SESSION['logged_user'])) {
    $user = $userDb->getUser($_SESSION['logged_user']);
}
//Operaci může provést jen přihlášený uživatel!
if (!isset($user)) {
    header('Location: ../login');
    exit();
}


$lessonDb = new LessonRepository();

$response = $lessonDb->reserveLesson($user, $params["lessonId"]);

$uri = "";
if (!$response) {
    $uri = 'Location: ../lectures?lectures=' . $params["lectures"] . '&lock=true';
    exit();
} else {
    sendEmail($user[0]["email"], "Lesson registered");
    $uri = 'Location: ../lectures?lectures=' . $params["lectures"] . '&lock=false';
}

header($uri);
exit();

?>