<div class="note-editor">

<h1 class="bold">add new note</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login-form">
    <div class="inp form-floating mb-5">
        <input type="text" class="form-control" name="title" id="title" placeholder="&nbsp;" required>
        <label for="name">title</label>
    </div>
    <div class="inp form-floating">
        <textarea rows="20" class="form-control text-area" name="text" id="text"required placeholder="&nbsp;"></textarea>
        <label for="name">your note</label>
    </div>
    <button type="submit" name="btn_add_note" class="btn-log" value="enter">save</button>
    <?php include ('controller/fce_error.php'); ?>
</form>

</div>