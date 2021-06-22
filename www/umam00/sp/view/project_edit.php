<?php include ('model/project_select.php') ?>
<div class="note-editor">
    <h1 class="bold">Edit project</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login-form">
        <div class="inp form-floating mb-4">
            <input type="text" class="form-control" name="title" id="title" value="<?php echo GetProjectName($_GET["proj_id"]); ?>"placeholder="&nbsp;" required>
            <label for="name">name</label>
        </div>
        <label class="mb-2" for="text">description</label>
        <div class="inp form-floating description">
            <textarea id="mytextarea" name="text"><?php echo GetProjectDesc($_GET["proj_id"]); ?></textarea>
        </div>
        <p class="mb-0 bold">Insert email of a member devided by comma.</p>
        <p class="text-muted">e.g. example@email.com, example2@email.com, example3@email.com</p>
        <div class="inp form-floating mb-4">
            <input type="text" class="form-control" name="members" id="members" value="<?php echo GetProjectMembers($_GET["proj_id"]); ?>" placeholder="&nbsp;">
            <label for="name">members</label>
        </div>
        <?php if(isset($_GET["error"])) echo'<p class="error_msg">Emails are incorrect, check duplcity or syntax.</p>';?>
        <button type="submit" name="btn_edit_project" class="btn-log" value="edit_project">edit</button>
        <button type="submit" name="btn_edit_project" class="btn-del mt-3" value="delete" onclick="return confirm('Are you sure you want to delete this project?');">delete</button>
        <?php include ('controller/fce_error.php'); ?>
    </form>

</div> 