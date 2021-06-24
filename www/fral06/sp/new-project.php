<?php
session_start();
require_once __DIR__ . '/models/ProjectDB.php';
require_once __DIR__ . '/models/UserDB.php';
require_once __DIR__ . '/models/UsersProjectDB.php';

if ((!($_SESSION['user_email']))) {
    header('Location: index.php');
    die();
}

$projectManager = new ProjectDB();
$userManger = new UserDB();
$usersProjectManager = new UsersProjectDB();
$users = $userManger->fetchAll();

$invalidInputs = [];
$msg = '';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $title = htmlspecialchars(trim(($_POST['title'])));
    $description = htmlspecialchars(trim(($_POST['description'])));
    $pickedUsers = [];
    if (isset($_POST['users']) && is_array($_POST['users'])) {
        foreach ($_POST['users'] as $user){
            array_push($pickedUsers, htmlspecialchars(trim($user)));
        }
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
        $projectId = ($projectManager->insert($title, $description, $_SESSION['user_email']));
        $usersProjectManager->insert($projectId, $_SESSION['user_email']);
        if (count($pickedUsers )> 0) {
            foreach ($pickedUsers as $user) {
                $usersProjectManager->insert($projectId, $user);
            }
        }
       header('Location: main.php');

    }
}



//Head
include "components/head.php";
//Navigation
include "components/nav.php"
?>

    <div class="container d-flex align-items-center justify-content-center">
        <main class="form-signin ">
            <form method="POST">
                <h1 class="h3 mb-3 fw-normal text-center">Create a new project</h1>
                <?php if ($msg != '') : ?>
                    <div class="alert alert-danger"><?php echo $msg; ?></div>
                <?php endif; ?>
                <div class="mb-3">
                    <label class="form-label" for="title">Title:</label>
                    <input type="text" aria-label="Project title" class="form-control" name="title" id="title" placeholder="Project title">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">Description:</label>
                    <textarea aria-label="Project description" class="form-control" placeholder="Project description" name="description" id="description"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="users">Add members to project:</label>
                    <select name="users[]" id="users" class="form-select"  multiple aria-label="select multiple users">
                        <?php foreach ($users as $user) :?>
                            <?php if($user['email'] != $_SESSION['user_email']) : ?>
                                <option value="<?php  echo $user['email']; ?>"><?php  echo $user['lastName'] . ', ' . $user['firstName']?></option>
                            <?php endif; ?>
                     <?php endforeach; ?>
                    </select>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Create a Project!</button>
                <p class="mt-5 mb-3 text-muted text-center">© 2021</p>
            </form>
        </main>
    </div>

<?php
include "components/foot.php";
?>