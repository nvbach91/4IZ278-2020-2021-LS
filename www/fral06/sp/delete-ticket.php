<?php
session_start();

require_once __DIR__ . '/models/TaskDB.php';
require_once __DIR__ . '/models/UsersTaskDB.php';
require_once __DIR__ . '/models/UsersProjectDB.php';


if (!$_SESSION['user_email'] || !isset($_GET['projectId'])) {
    header('Location: index.php');
    die();
}

$usersProjectManager = new UsersProjectDB();
$userHasProject = $usersProjectManager->fetchUsersProject($_SESSION['user_email'], $_GET['projectId']);

if ($_SESSION['role'] != 2 && !$userHasProject) {
    header('Location: main.php');
}

$id = @$_POST['id'];
$taskManager = new TaskDB();
$usersTaskManager = new UsersTaskDB();
$usersTaskManager->deleteUsersTask($id);
$taskManager->deleteTask($id);
header('Location: project-detail.php?id='. $_GET['projectId']);
exit();

?>