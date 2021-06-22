<?php
session_start();
require_once __DIR__ . '/models/TaskDB.php';

if ((!($_SESSION['user_email']))) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['id'])) {
    header('Location: main.php');
}

$taskManager = new TaskDB();
$ticket = $taskManager->fetchById(htmlspecialchars($_GET['id']));
if (!$ticket) {
    header('Location: main.php');
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $invalidInputs = [];
    $msg = '';


    $title = htmlspecialchars(trim(($_POST['title'])));
    $description = htmlspecialchars(trim(($_POST['description'])));
    $storyPoints = htmlspecialchars(trim(($_POST['storyPoints'])));

    if (!$title) {
        array_push($invalidInputs, 'Title is empty');
        $msg = 'Title is empty';
    }

    if (!$description) {
        array_push($invalidInputs, 'Description is empty');
        $msg = 'Description is empty';
    }


    if (strlen($title) < 2) {
        array_push($invalidInputs, 'Task name length');
        $msg = 'Task name has to have 2 characters min.';
    }

    if (strlen($description) < 2) {
        array_push($invalidInputs, 'Description length');
        $msg = 'Description  has to have 2 characters min.';
    }

    if (strlen($storyPoints) < 0) {
        array_push($invalidInputs, 'Storypoints invalid value');
        $msg = 'Storypoints has to be a positive number.';
    }

    if (empty($invalidInputs)) {
        $taskManager->updateTask($title, $description, $storyPoints, $_GET['id']);
        header('Location: ticket-detail.php?id=' . $_GET['id']);
    }
}

//Head
include "components/head.php";
//Navigation
include "components/nav.php";

?>

<div class="container d-flex align-items-center justify-content-center">
    <main class="form-signin text-center">
        <form method="POST">
            <h1 class="h3 mt-3 mb-3 fw-normal">Update the task</h1>
            <?php if ($msg != '') : ?>
                <div class="alert alert-danger"><?php echo $msg; ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <input required type="text" aria-label="Task title" class="form-control"
                       value="<?php echo $ticket['title'] ?>" name="title" id="title" placeholder="Task title">
            </div>
            <div class="mb-3">
                <textarea aria-label="Task description" class="form-control" placeholder="Task description"
                          name="description" id="description"><?php echo $ticket['description'] ?></textarea>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" aria-label="Task story points"
                       value="<?php echo $ticket['storyPoints'] ?>" name="storyPoints" placeholder="0">
            </div>

            <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Edit!</button>
            <a href="javascript:history.go(-1)" class="w-100 btn btn-lg btn-danger" type="submit">Back</a>
            <p class="mt-5 mb-3 text-muted">© 2021</p>
        </form>
    </main>
</div>

<?php
include "components/foot.php";
?>
