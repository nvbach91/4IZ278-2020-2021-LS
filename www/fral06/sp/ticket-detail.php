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
$moveForwardText = '';
$moveBackText = '';
if ($ticket['status'] == 1) {
    $moveForwardText = 'Start work';
}

else if ($ticket['status'] == 2) {
    $moveForwardText = 'Start Review';
    $moveBackText = 'Pending';
}

else if ($ticket['status'] == 3) {
    $moveForwardText = 'Done';
    $moveBackText = 'Send back to dev';
}

else if ($ticket['status'] == 4) {
    $moveBackText = 'Back to Review';
}

//Head
include "components/head.php";
//Navigation
include "components/nav.php";

?>
<div class="container w-50 mt-3">
    <div class="mt-2">
        <a  class="btn btn-link" href="project-detail.php?id=<?php echo $ticket['project_id'] ?>">Back</a>
    </div>
    <h1 class="text-center mb-5">Ticket details</h1>
    <div class="mb-3">
        <?php if ($ticket['status'] < 4) :?>
            <form class="d-inline"  action="moveTicket.php" method="post">
                <input class="d-none" name="status" value="<?php echo ($ticket['status']+1) ?>" >
                <input class="d-none" name="id" value="<?php echo $ticket['task_id'] ?>" >
                <button type="submit" class="btn btn-primary"><?php echo $moveForwardText ?></button>
            </form>
        <?php endif;?>
        <?php if ($ticket['status'] > 1) :?>
            <form class="d-inline"  action="moveTicket.php" method="post">
                <input class="d-none" name="status" value="<?php echo ($ticket['status']-1) ?>" >
                <input class="d-none" name="id" value="<?php echo $ticket['task_id'] ?>" >
                <button type="submit" class="btn btn-primary"><?php echo $moveBackText ?></button>
            </form>
        <?php endif;?>


        <form class="d-inline" action="delete-ticket.php?projectId=<?php echo $ticket['project_id'] ?>" method="post">
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
