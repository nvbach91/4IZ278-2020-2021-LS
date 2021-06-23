<?php
session_start();
require_once __DIR__ . '/models/ProjectDB.php';
require_once __DIR__ . '/models/UserDB.php';
require_once __DIR__ . '/models/UsersProjectDB.php';

if ((!($_SESSION['user_email']))) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['id'])) {
    header('Location: main.php');
}

$projectManager = new ProjectDB();
$project = $projectManager->fetchProjectById(htmlspecialchars($_GET['id']));
if (!$project || ($_SESSION['user_email'] != $project['author'] && $_SESSION['role'] !=2)) {
    header('Location: main.php');
}

$usersProjectManager = new UsersProjectDB();
$assignees = $usersProjectManager->fetchProjectAssignees($_GET['id']);


$userManger = new UserDB();
$users = $userManger->fetchAll();

$invalidInputs = [];
$msg = '';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $title = htmlspecialchars(trim(($_POST['title'])));
    $description = htmlspecialchars(trim(($_POST['description'])));
    $pickedUsers = [];
    foreach ($_POST['users'] as $user){
        array_push($pickedUsers, htmlspecialchars(trim($user)));
    }

    if (!$title) {
        array_push($invalidInputs, 'Title is empty');
        $msg = 'Title is empty';
    }

    if (!$description) {
        array_push($invalidInputs, 'Description is empty');
        $msg = 'Description is empty';
    }


    if (strlen($title) < 2) {
        array_push($invalidInputs, 'Project name length');
        $msg = 'Project name has to have 2 characters min.';
    }

    if (strlen($description) < 2) {
        array_push($invalidInputs, 'Description length');
        $msg = 'Description  has to have 2 characters min.';
    }

    if (empty($invalidInputs)) {
       foreach ($pickedUsers as $newAsg) {
           if(!isAssigne($newAsg, $assignees)){
               $usersProjectManager->insert($_GET['id'], $newAsg);
           }
       }
       foreach ($assignees as $assignee) {
           $assigned = false;
           foreach ($pickedUsers as $pickedUser) {
               if($assignee['email'] == $pickedUser) {
                   $assigned = true;
                   break;
               }
           }
           if (!$assigned) {
               $usersProjectManager->deleteUserProject($assignee['email'], $_GET['id']);
           }
       }
        $projectManager->updateProject($title, $description, $_GET['id']);
        header('Location: project-detail.php?id=' . $_GET['id']);

    }
}

function isAssigne($email,$assignees) {
    foreach ($assignees as $assignee) {
        if($assignee['email'] == $email)
            return true;
    }
    return false;
}


//Head
include "components/head.php";
//Navigation
include "components/nav.php"
?>

    <div class="container d-flex align-items-center justify-content-center">
        <main class="form-signin text-center">
            <form method="POST">
                <h1 class="h3 mb-3 mt-3 fw-normal">Edit the project</h1>
                <?php if ($msg != '') : ?>
                    <div class="alert alert-danger"><?php echo $msg; ?></div>
                <?php endif; ?>
                <div class="mb-3">
                    <input type="text" aria-label="Project title" class="form-control" value="<?php echo $project['name'] ?>" name="title" id="title" placeholder="Project title">
                </div>
                <div class="mb-3">
                    <textarea aria-label="Project description" class="form-control" placeholder="Project description" name="description" id="description"><?php echo $project['description'] ?></textarea>
                </div>
                <div class="mb-3">

                    <select name="users[]" id="users" class="form-select" multiple aria-label="select multiple users">
                        <?php foreach ($users as $user) :?>
                            <option value="<?php  echo $user['email']; ?>"
                                <?php echo isAssigne($user['email'], $assignees) ? 'selected' : '' ?>>
                                    <?php  echo $user['lastName'] . ', ' . $user['firstName']?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Edit!</button>
                <p class="mt-5 mb-3 text-muted">© 2021</p>
            </form>
        </main>
    </div>

<?php
include "components/foot.php";
?>