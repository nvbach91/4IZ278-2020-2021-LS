<?php
    include('model/project_note_ver.php');
    if($data)
    {
        include('model/project_note_select.php');
        if(CheckAcces($_SESSION["NOTE_ID"], $_SESSION["ID"]))
        {
            foreach ($data as $row)
            {?>
                <div class="note-editor">
                    <h1 class="bold">edit note</h1>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login-form">
                        <div class="inp mb-5">
                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $row["name"];?>" required>
                        </div>
                        <div class="inp form-floating">
                            <textarea id="mytextarea" name="text"><?php echo $row["content"];?></textarea>
                        </div>
                        <input type="hidden" name="next_page" value="<?php echo $_GET['projects']; ?>">
                        <button type="submit" name="btn_update_projnote" class="btn-log" value="update">save</button>
                        <button type="submit" name="btn_update_note" class="btn-del mt-3" value="delete" onclick="return confirm('Are you sure you want to delete this note?');">delete</button>
                        <?php include ('controller/fce_error.php'); ?>
                    </form>
                        
                </div>
            <?php
            }
        }
        else
        {
            ?>
                <div class="note-editor">
                    <h1 class="bold">Unfortunately, somebody is already editing this note.</h1>     
                    <p>Try later :)</p>
                </div>      
            <?php
        }
    }
    else
    {
       include('controller/reset_page.php');
    } 
?>