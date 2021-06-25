<?php
session_start();
require_once __DIR__ . '/models/UsersProjectDB.php';
require_once __DIR__ . '/models/UsersTaskDB.php';
require_once __DIR__ . '/models/TaskDB.php';
if (!$_SESSION['user_email'] || !isset($_POST['projectId']) || !isset($_POST['id'])) {
    header('Location: index.php');
    die();
}

$usersProjectManager = new UsersProjectDB();
$userHasProject = $usersProjectManager->fetchUsersProject($_SESSION['user_email'], $_POST['projectId']);

if ($_SESSION['role'] != 2 && !$userHasProject) {
    header('Location: main.php');
}

$taskManager = new TaskDB();
$task = $taskManager->fetchById($_POST['id']);

if ($task) {
    $usersTaskManager = new UsersTaskDB();
    $usersTaskManager->deleteUsersTask($task['task_id']);
    header('Location: ticket-detail.php?id='.$_POST['id']);
}





