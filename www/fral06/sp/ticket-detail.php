<?php
session_start();

require_once __DIR__ . '/models/TaskDB.php';

if ((!($_SESSION['user_email']))) {
    header('Location: index.php');
    die();
}

if(!isset($_GET['id'])){
    header('Location: main.php');
}

$taskManager = new TaskDB();
$ticket = $taskManager->fetchById(htmlspecialchars($_GET['id']));


if(!$ticket) {
    header('Location: main.php');
}


//Head
include "components/head.php";
//Navigation
include "components/nav.php";

?>
<div class="container w-50 mt-3">
    <h1 class="text-center mb-5">Ticket details</h1>
    <div class="mb-3">
        <button class="btn btn-primary">Move next</button>
        <form class="d-inline" action="delete-ticket.php?projectId=<?php echo $_GET['projectId'] ?>" method="post">
            <input class="d-none" name="id" value="<?php echo $ticket['task_id'] ?>" >
            <button type="submit" class="btn btn-danger">Delete ticket</button>
        </form>
        <a class="btn btn-danger" href="edit-ticket.php?id=<?php echo $ticket['task_id']?>">Edit</a>
    </div>
    <div class="mb-2">
        <span class="fw-bold">Title:</span> <?php echo $ticket['title'] ?>
    </div>
    <div class="mb-2">
        <span class="fw-bold"> Description: </span>
        <p class="mb-0"><?php echo $ticket['description'] ?></p>
    </div>
    <div class="mb-2">
        <span class="fw-bold">Assignee: </span> <span class="fst-italic">Unassigned</span>
        <form method="post" class="d-inline"><button class="btn btn-link" type="submit">Assign to me</button></form>
    </div>
    <div class="mb-2">
        <span class="fw-bold">Story points: </span> <?php echo $ticket['storyPoints'] ?>
    </div>
    <div class="mb-2">
        <span class="fw-bold">Created on : </span> <span class="fst-italic"> <?php echo$ticket['createdAt'] ?></span>
    </div>

</div>

<?php
include "components/foot.php";
?>
