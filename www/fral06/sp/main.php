<?php
session_start();

require_once __DIR__ . '/models/ProjectDB.php';
require_once __DIR__ . '/models/UsersTaskDB.php';
require_once __DIR__ . '/models/UsersProjectDB.php';

if ((!($_SESSION['user_email']))) {
    header('Location: index.php');
    die();
}

$projectManager = new ProjectDB();
$userProjectManager = new UsersProjectDB();
$tasksManager = new UsersTaskDB();

if ($_SESSION['role'] == 1 ) {
    $projects = $userProjectManager->fetchAllUsersProjects($_SESSION['user_email']);

} else {
    $projects = $projectManager->fetchProjectByEmail($_SESSION['user_email']);
}
$tasks = $tasksManager->fetchAllUsersTasks($_SESSION['user_email']);
//Head
include "components/head.php";
//Navigation
include "components/nav.php";


?>

<div class="container">
    <div>
        <a href="new-project.php" class="btn btn-link">New project</a>
    </div>
    <h1 class="text-center mb-2">Welcome <?php echo $_SESSION['firstName']?>!</h1>
    <div class="row">
        <div class="col-8">
            <h2>Project List</h2>
            <div class="projects">
                <?php foreach ($projects as  $project) { ?>
                    <div class="card mb-2 me-2" style="width: 18rem;">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $project['name']; ?></h4>
                            <p class="card-text"><?php echo $project['description']; ?></p>
                            <a href="project-detail.php?id=<?php echo $project['project_id']; ?>" class="btn btn-primary">Project Detail</a>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
        <div class="col-4">
            <h2>Project Tasks</h2>
            <?php foreach ($tasks as $task) : ?>
                <div class="card" style="width: 100%;">
                    <div class="card-body d-flex justify-content-around align-items-baseline">
                        <h5 class="card-title"><?php echo $task['name'] . ' - ' . $task['title']; ?></h5>
                        <a href="ticket-detail.php?id=<?php echo $task[task_id]?>" class="btn btn-primary">View</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<?php
include "components/foot.php";
?>
