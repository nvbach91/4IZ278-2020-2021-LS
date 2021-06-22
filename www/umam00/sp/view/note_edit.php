<?php
    include('model/note_ver.php');
    if($data)
    {
        include('model/note_select.php');
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
                    <button type="submit" name="btn_update_note" class="btn-log" value="update">save</button>
                    <button type="submit" name="btn_update_note" class="btn-del mt-3" value="delete" onclick="return confirm('Are you sure you want to delete this note?');">delete</button>
                    <?php include ('controller/fce_error.php'); ?>
                </form>
                    
            </div>
        <?php
        }
    }
    else
    {
       include('controller/reset_page.php');
    } 
?>