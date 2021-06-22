<?php

require_once __DIR__ . '/models/ProjectDB.php';
require_once __DIR__ . '/models/UserDB.php';
require_once __DIR__ . '/models/TaskDB.php';
//Head
include "components/head.php";
//Navigation
include "components/nav.php";

$projectManager = new ProjectDB();
$userManager = new UserDB();
$taskManager = new TaskDB();
$project = $projectManager->fetchProjectById(htmlspecialchars($_GET['id']));
$author = $userManager->fetchUserByEmail($project['author']);
$tasks = $taskManager->fetchByProject($project['project_id']);

//var_dump($tasks);
?>

<div class="container text-center ">
    <h1 class="mt-5 mb-3" ><?php echo $project['name']?></h1>
    <p><?php echo $project['description']?></p>
    <p>Author: <?php echo $author['firstName'] .' '. $author['lastName'] ?></p>
    <div class="row">
        <div class="col-3">
            <div class="project-row">
                <div class="project-row__title">
                    Ready
                </div>
                <?php foreach ($tasks as $task) : ?>
                <?php if($task['status'] == 1 ) :?>
                        <div class="project-item">
                            <div class="project-item__info">
                                <a href="#" class="link project-item__id"><?php echo $task['task_id']?></a>
                                <div class="project-item__title"><?php echo $task['description']?></div>
                                <div class="project-item__assignee"><?php echo $task['description']?></div>
                            </div>
                            <div class="project-item__points"><?php echo $task['storyPoints']?></div>
                        </div>
                    <?php endif;?>
                <?php endforeach; ?>
            </div>


        </div>
        <div class="col-3">

            <div class="project-row">
                <div class="project-row__title">
                    In progress
                </div>
                <?php foreach ($tasks as $task) : ?>
                    <?php if($task['status'] == 2 ) :?>
                        <div class="project-item">
                            <div class="project-item__info">
                                <a href="#" class="link project-item__id"><?php echo $task['task_id']?></a>
                                <div class="project-item__title"><?php echo $task['description']?></div>
                                <div class="project-item__assignee"><?php echo $task['description']?></div>
                            </div>
                            <div class="project-item__points"><?php echo $task['storyPoints']?></div>
                        </div>
                    <?php endif;?>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="col-3">
            <div class="project-row">
                <div class="project-row__title">
                    Review
                </div>
                <?php foreach ($tasks as $task) : ?>
                    <?php if($task['status'] == 3 ) :?>
                        <div class="project-item">
                            <div class="project-item__info">
                                <a href="#" class="link project-item__id"><?php echo $task['task_id']?></a>
                                <div class="project-item__title"><?php echo $task['description']?></div>
                                <div class="project-item__assignee"><?php echo $task['description']?></div>
                            </div>
                            <div class="project-item__points"><?php echo $task['storyPoints']?></div>
                        </div>
                    <?php endif;?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-3">
           <div class="project-row">
               <div class="project-row__title">
                   Done
               </div>
               <?php foreach ($tasks as $task) : ?>
                   <?php if($task['status'] == 4 ) :?>
                       <div class="project-item">
                           <div class="project-item__info">
                               <a href="#" class="link project-item__id"><?php echo $task['task_id']?></a>
                               <div class="project-item__title"><?php echo $task['description']?></div>
                               <div class="project-item__assignee"><?php echo $task['description']?></div>
                           </div>
                           <div class="project-item__points"><?php echo $task['storyPoints']?></div>
                       </div>
                   <?php endif;?>
               <?php endforeach; ?>
           </div>
        </div>
    </div>
</div>
