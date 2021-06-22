<?php

require_once __DIR__ . '/models/ProjectDB.php';
require_once __DIR__ . '/models/UserDB.php';
//Head
include "components/head.php";
//Navigation
include "components/nav.php";

$projectManager = new ProjectDB();
$userManager = new UserDB();
$project = $projectManager->fetchProjectById(htmlspecialchars($_GET['id']));
$author = $userManager->fetchUserByEmail($project['author']);


?>

<div class="container text-center ">
    <h1 class="mt-5 mb-3" ><?php echo $project['name']?></h1>
    <p><?php echo $project['desc']?></p>
    <p>Author: <?php echo $author['firstName'] .' '. $author['lastName'] ?></p>
    <div class="row">
        <div class="col-3">
            <div class="project-row">
                <div class="project-row__title">
                    Ready
                </div>
                <div class="project-item">
                    <div class="project-item__info">
                        <a href="#" class="link project-item__id">AIR-575</a>
                        <div class="project-item__title">Fix some issue</div>
                        <div class="project-item__assignee">Karel Omacka</div>
                    </div>
                    <div class="project-item__points">5</div>
                </div>
            </div>


        </div>
        <div class="col-3">

            <div class="project-row">
                <div class="project-row__title">
                    In progress
                </div>
                <div class="project-item"></div>
            </div>

        </div>
        <div class="col-3">
            <div class="project-row">
                <div class="project-row__title">
                    Review
                </div>
                <div class="project-item"></div>
            </div>
        </div>
        <div class="col-3">
           <div class="project-row">
               <div class="project-row__title">
                   Done
               </div>
               <div class="project-item"></div>
           </div>
        </div>
    </div>
</div>
