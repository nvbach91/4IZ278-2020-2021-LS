<div class="note-editor">

    <h1 class="bold">add new project</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login-form">
        <div class="inp form-floating mb-4">
            <input type="text" class="form-control" name="title" id="title" placeholder="&nbsp;" required>
            <label for="name">name</label>
        </div>
        <label class="small_title" for="text">description</label>
        <div class="inp form-floating description">
            <textarea id="mytextarea" name="text"></textarea>
        </div>
        <button type="submit" name="btn_add_project" class="btn-log" value="add_project">add project</button>
        <?php include ('controller/fce_error.php'); ?>
    </form>

</div> 