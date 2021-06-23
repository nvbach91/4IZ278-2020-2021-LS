<?php
session_start();

if ((!($_SESSION['user_email']))) {
    header('Location: index.php');
    die();
}
require_once __DIR__ . '/models/ProjectDB.php';
require_once __DIR__ . '/models/UserDB.php';
require_once __DIR__ . '/models/TaskDB.php';
//Head
include "components/head.php";
//Navigation
include "components/nav.php";

if(!isset($_GET['id'])){
    header('Location: main.php');
}

$projectManager = new ProjectDB();
$userManager = new UserDB();
$taskManager = new TaskDB();

$project = $projectManager->fetchProjectById(htmlspecialchars($_GET['id']));

if(!$project) {
    header('Location: main.php');
}

$author = $userManager->fetchUserByEmail($project['author']);
$tasks = $taskManager->fetchByProject($project['project_id']);

?>

<div class="container text-center ">
    <div class="text-start mt-3">
        <a role="link" class="btn btn-success" href="create-ticket.php?project_id=<?php echo htmlspecialchars($_GET['id']) ?>">Add Task</a>
        <a role="link" class="btn btn-success" href="edit-project.php?id=<?php echo htmlspecialchars($_GET['id']) ?>">Edit Project</a>

    </div>
    <h1 class=" mb-3" ><?php echo $project['name']?></h1>
    <p><?php echo $project['description']?></p>
    <p>Author: <?php echo $author['firstName'] .' '. $author['lastName'] ?></p>
    <div class="row">
        <div class="col-3">
            <div class="project-row">
                <div class="project-row__title mb-3">
                    Ready
                </div>
                <?php foreach ($tasks as $task) : ?>
                <?php if($task['status'] == 1 ) :?>
                        <div class="project-item">
                            <div class="project-item__text mb-1">
                                <div class="project-item__info">
                                    <a href="ticket-detail.php?id=<?php echo $task['task_id']?>&projectId=<?php echo $task['project_id']?>" class="link project-item__id"><?php echo $task['task_id']?></a>
                                    <div class="project-item__title"><?php echo $task['title']?></div>
                                    <div class="project-item__assignee"><?php echo $task['description']?></div>
                                </div>
                                <div class="project-item__points"><?php echo $task['storyPoints']?></div>
                            </div>
                                <form class="d-inline"  action="moveTicket.php?projectId=<?php echo  $task['project_id']?>" method="post">
                                    <input class="d-none" name="status" value="<?php echo ($task['status']+1) ?>" >
                                    <input class="d-none" name="id" value="<?php echo $task['task_id'] ?>" >
                                    <button type="submit" class="btn btn-success">Start work</button>
                                </form>
                        </div>
                    <?php endif;?>
                <?php endforeach; ?>
            </div>


        </div>
        <div class="col-3">

            <div class="project-row">
                <div class="project-row__title  mb-3">
                    In progress
                </div>
                <?php foreach ($tasks as $task) : ?>
                    <?php if($task['status'] == 2 ) :?>
                        <div class="project-item">
                            <div class="project-item__info">
                                <a href="ticket-detail.php?id=<?php echo $task['task_id']?>&projectId=<?php echo $task['project_id']?>" class="link project-item__id"><?php echo $task['task_id']?></a>
                                <div class="project-item__title"><?php echo $task['description']?></div>
                                <div class="project-item__assignee"><?php echo $task['description']?></div>
                            </div>
                            <div class="project-item__points"><?php echo $task['storyPoints']?></div>
                            <div class="project-item__controllers">
                                <form class="d-inline"  action="moveTicket.php?projectId=<?php echo  $task['project_id']?>" method="post">
                                    <input class="d-none" name="status" value="<?php echo ($task['status']+1) ?>" >
                                    <input class="d-none" name="id" value="<?php echo $task['task_id'] ?>" >
                                    <button type="submit" class="btn btn-success">Start Review'</button>
                                </form>
                                <form class="d-inline"  action="moveTicket.php?projectId=<?php echo  $task['project_id']?>" method="post">
                                    <input class="d-none" name="status" value="<?php echo ($task['status']-1) ?>" >
                                    <input class="d-none" name="id" value="<?php echo $task['task_id'] ?>" >
                                    <button type="submit" class="btn btn-primary">Pending</button>
                                </form>
                            </div>

                        </div>
                    <?php endif;?>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="col-3">
            <div class="project-row">
                <div class="project-row__title  mb-3">
                    Review
                </div>
                <?php foreach ($tasks as $task) : ?>
                    <?php if($task['status'] == 3 ) :?>
                        <div class="project-item">
                            <div class="project-item__info">
                                <a href="ticket-detail.php?id=<?php echo $task['task_id']?>&projectId=<?php echo $task['project_id']?>" class="link project-item__id"><?php echo $task['task_id']?></a>
                                <div class="project-item__title"><?php echo $task['description']?></div>
                                <div class="project-item__assignee"><?php echo $task['description']?></div>
                            </div>
                            <div class="project-item__points"><?php echo $task['storyPoints']?></div>
                            <div class="project-item__controllers">
                                <form class="d-inline"  action="moveTicket.php?projectId=<?php echo  $task['project_id']?>" method="post">
                                    <input class="d-none" name="status" value="<?php echo ($task['status']+1) ?>" >
                                    <input class="d-none" name="id" value="<?php echo $task['task_id'] ?>" >
                                    <button type="submit" class="btn btn-success">Done</button>
                                </form>
                                <form class="d-inline"  action="moveTicket.php?projectId=<?php echo  $task['project_id']?>" method="post">
                                    <input class="d-none" name="status" value="<?php echo ($task['status']-1) ?>" >
                                    <input class="d-none" name="id" value="<?php echo $task['task_id'] ?>" >
                                    <button type="submit" class="btn btn-primary">Send back to dev</button>
                                </form>
                            </div>
                        </div>
                    <?php endif;?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-3">
           <div class="project-row">
               <div class="project-row__title  mb-3">
                   Done
               </div>
               <?php foreach ($tasks as $task) : ?>
                   <?php if($task['status'] == 4 ) :?>
                       <div class="project-item">
                           <div class="project-item__info">
                               <a href="ticket-detail.php?id=<?php echo $task['task_id']?>&projectId=<?php echo $task['project_id']?>" class="link project-item__id"><?php echo $task['task_id']?></a>
                               <div class="project-item__title"><?php echo $task['description']?></div>
                               <div class="project-item__assignee"><?php echo $task['description']?></div>
                           </div>
                           <div class="project-item__points"><?php echo $task['storyPoints']?></div>
                           <form class="d-inline"  action="moveTicket.php?projectId=<?php echo  $task['project_id']?>" method="post">
                               <input class="d-none" name="status" value="<?php echo ($task['status']-1) ?>" >
                               <input class="d-none" name="id" value="<?php echo $task['task_id'] ?>" >
                               <button type="submit" class="btn btn-primary">Back to Review</button>
                           </form>
                       </div>
                   <?php endif;?>
               <?php endforeach; ?>
           </div>
        </div>
    </div>
</div>
