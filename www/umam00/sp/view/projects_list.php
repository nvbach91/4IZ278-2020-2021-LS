<div class="main-container">
        <div class="row main-headline">
            <h1 class="bold"><a href="?projects" class="active" >your projects</a>/ <a href="?shared_projects">projects shared with you</a></h1>
        </div>
        <div class="grid">
            <?php
                include('model/projects_import.php');
                foreach ($data as $row)
                {
                ?>
                <div class="item">
                   <div class="note">
                    <h2><?php echo $row['name']; ?></h2>
                        <div class="note-body">
                            <p>
                            <?php 
                            if(strlen($row['description'])>249)
                            {
                                echo substr($row['description'], 0, 250);
                                echo " ...";
                            }
                            else
                            {
                                echo $row['description'];
                            }
                            
                            ?>
                            </p>
                        </div>
                        <span class="date"><?php echo date('d.m.Y', strtotime($row["date_of_creation"])); ?></span>                   
                        <a class="fill_link" href="?projects=<?php echo $row['id_project'];?>"></a>
                   </div>
                </div>
                <?php
                } 
            ?>
        </div>
        <div class="insert-btn" id="insert_project">
            <a href="?add=project"><i class="material-icons">add</i></a>
        </div>
    </div>