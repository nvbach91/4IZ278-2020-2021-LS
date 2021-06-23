<?php
session_start();

require_once __DIR__ . '/models/TaskDB.php';

if ((!($_SESSION['user_email'])) || !isset($_POST['id']) || !isset($_POST['status'])) {
    header('Location: index.php');
    die();
}

$id = $_POST['id'];
$status = $_POST['status'];
$taskManager = new TaskDB();
$taskManager->updateTaskStatus($status, $id);

if(isset($_GET['projectId'])) {
    header('Location: project-detail.php?id='. $_GET['projectId']);
} else {
    header('Location: ticket-detail.php?id='. $_POST['id']);
}


