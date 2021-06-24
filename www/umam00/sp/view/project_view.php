<div class="main-container">
        <div class="row main-headline">
            <h1 class="bold"><?php echo GetProjectName($_GET['projects']); ?></h1>
            <p class="text-muted"><?php echo GetProjectDesc($_GET['projects']); ?></p>
            <span class="owner-label"><span class="label">Project owner</span><?php echo getProjectOwner($_GET['projects']); ?></span>
        </div>
        <div class="grid">
            <?php
                include('model/project_notes_import.php');
                foreach ($data as $row)
                {
                ?>
                <div class="item">
                   <div class="note">
                    <h2><?php echo $row['name']; ?></h2>
                        <div class="note-body">
                            <p>
                            <?php 
                            if(strlen($row['content'])>249)
                            {
                                echo substr($row['content'], 0, 250);
                                echo " ...";
                            }
                            else
                            {
                                echo $row['content'];
                            }
                            
                            ?>
                            </p>
                        </div>
                        <span class="date"><?php echo date('d.m.Y', strtotime($row["date_of_creation"])); ?></span>                   
                        <a class="fill_link" href="?projects=<?php echo $_GET['projects'] . "&proj_note=" .$row['id_note'];?>"></a>
                   </div>
                </div>
                <?php
                } 
            ?>
        </div>
        <div class="insert-btn" id="insert_project">
            <?php if(CheckOwner($_SESSION["ID"], $_GET["projects"]))
              {?>
                 <a href="?edit=project&proj_id=<?php echo $_GET['projects'] ?>"><i class="material-icons d-block mb-3">settings</i></a>
             <?php }?>
            <a href="?add=project_note&proj_id=<?php echo $_GET['projects'] ?>"><i class="material-icons d-block">add</i></a>
        </div>
    </div>