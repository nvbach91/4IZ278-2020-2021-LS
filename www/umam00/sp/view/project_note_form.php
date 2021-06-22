<div class="note-editor">

<h1 class="bold">add new note to project</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login-form">
    <input type="text"  name="project_id" id="project_id" class="d-none"value="<?php echo $_GET['proj_id'];?>">
    <div class="inp form-floating mb-5">
        <input type="text" class="form-control" name="title" id="title" placeholder="&nbsp;" required>
        <label for="name">title</label>
    </div>
    <div class="inp form-floating">
        <textarea id="mytextarea" name="text"></textarea>
    </div>
    <button type="submit" name="btn_add_project_note" class="btn-log" value="enter">save</button>
    <?php include ('controller/fce_error.php'); ?>
</form>

</div>