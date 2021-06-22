<?php
//Head
include "components/head.php";
//Navigation
include "components/nav.php"
?>

<div class="container">
    <div>
        <a href="new-project.php" class="btn btn-link">New project</a>
    </div>
    <div class="row">
        <div class="col-8">
            <h2>Project List</h2>
            <div class="projects">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h4 class="card-title">Project one</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="project-detail.php" class="btn btn-primary">Project Detail</a>
                        <a href="#" class="btn btn-secondary">Project's task</a>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h4 class="card-title">Project one</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="project-detail.php" class="btn btn-primary">Project Detail</a>
                        <a href="#" class="btn btn-secondary">Project's task</a>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h4 class="card-title">Project one</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="project-detail.php" class="btn btn-primary">Project Detail</a>
                        <a href="#" class="btn btn-secondary">Project's task</a>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h4 class="card-title">Project one</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="project-detail.php" class="btn btn-primary">Project Detail</a>
                        <a href="#" class="btn btn-secondary">Project's task</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-4">
            <h2>Project Tasks</h2>
            <div class="card" style="width: 100%;">
                <div class="card-body d-flex justify-content-around align-items-baseline">
                    <h5 class="card-title">Project Name - Ticket title</h5>
                    <a href="#" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include "components/foot.php";
?>
