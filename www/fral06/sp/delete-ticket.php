<?php
session_start();

require_once __DIR__ . '/models/TaskDB.php';
require_once __DIR__ . '/models/UsersTaskDB.php';

if ((!($_SESSION['user_email']))) {
    header('Location: index.php');
    die();
}

$id = @$_POST['id'];
$taskManager = new TaskDB();
$usersTaskManager = new UsersTaskDB();
$usersTaskManager->deleteUsersTask($id);
$taskManager->deleteTask($id);
header('Location: project-detail.php?id='. $_GET['projectId']);
exit();

?>