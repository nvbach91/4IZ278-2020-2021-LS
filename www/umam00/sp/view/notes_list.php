<div class="main-container">
        <div class="row main-headline">
            <h1 class="bold">your notes</h1>
        </div>
        <div class="grid">
            <?php
                include('model/notes_import.php');
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
                        <a class="fill_link" href="?note=<?php echo $row['id_note'];?>"></a>
                   </div>
                </div>
                <?php
                } 
            ?>
        </div>
        <div class="insert-btn" id="insert_note">
            <a href="?add=note"><i class="material-icons">add</i></a>
        </div>
    </div>