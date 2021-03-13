

<h2>For this awesome test site</h2>
<p>Don't enter any real personal information.</p>
    
<form method="POST" action=" <?php $_SERVER['PHP_SELF']; ?> ">


    <div class="row mb-3">
        <label for="Nickname" class="form-label">Nickname:</label> <!-- or e-mail? -->
        <input name="nick" value="<?php isset($_GET['nick']) ? $_GET['nick'] : ''; ?>" class="form-control" id="Nickname">

    </div>

<div class="row mb-3">

        <label for="Pass" class="form-label">Password:</label>
        <input name="pass" value="" class="form-control" id="Pass" type="password">
        
    </div>

    <button type="register" class="btn btn-primary">Login</button>
</form>

