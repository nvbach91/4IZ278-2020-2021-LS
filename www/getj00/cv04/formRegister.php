
<!-- Fax version for people still using that, ALL CAPS = required.

      +-----------------------------------------------------------------+
   -*-+      R E G I S T R A T I O N   +-*-
      +-----------------------------------------------------------------+
               

Nickname: ____________  Avatar Link: __________________________________________

DATE OF BIRTH: _____-__-__  Password: ____________  Confirm: __________________

E-MAIL: __________________________________________      

[ ] I AGREE TO RECEIVE SPAM EVER AFTER.

-->

<h2>For this awesome test site</h2>
<p>Don't enter any real personal information.</p>
    
<form method="POST" action=" <?php $_SERVER['PHP_SELF']; ?> ">


    <div class="row mb-3">
        <label for="Nickname" class="form-label">Nickname:</label>
        <input name="nick" value="<?php isset($nick) ? $nick : ''; ?>" class="form-control" id="Nickname">

        <label for="Avatar" class="form-label">Avatar URL:</label>
        <input name="avatar" value="<?php isset($avatar) ? $avatar : ''; ?>" class="form-control" id="Avatar">
        <!-- Possible variation 
        <label class="form-label" for="AvatarFile">Avatar:</label>
        <input name="avatarFile" type="file" class="form-control" id="AvatarFile" />
        -->
    </div>

    <div class="row mb-3">

        <label for="DoB" class="form-label">Date of Birth:</label>
        <input name="dob" value="<?php isset($dob) ? $dob : 'Use ISO format, e.g. 1999-12-31'; ?>" class="form-control" id="DoB">
        
        
        <label for="E-mail" class="form-label">E-mail:</label>
        <input name="email" value="<?php isset($email) ? $email : 'e.g. someone@somewhere.com'; ?>" class="form-control" id="E-mail">
        
    </div>

<div class="row mb-3">

        <label for="Pass" class="form-label">Password:</label>
        <input name="pass" value="" class="form-control" id="Pass" type="password">
        
        
        <label for="Confirm" class="form-label">Confirm Password:</label>
        <input name="confirm" value="" class="form-control" id="Confirm" type="password">
        
    </div>

    
    <div class="form-check">
        <input name="agree" class="form-check-input" type="checkbox" value="" id="Agree" />
        <label class="form-check-label" for="Agree">I agree to receive spam ever after.</label>
    </div>

    <button type="register" class="btn btn-primary">Register</button>
</form>

