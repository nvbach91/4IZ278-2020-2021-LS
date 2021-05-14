<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_email'])) {
   header('Location: login.php');
   exit();
}
$name = @$_SESSION['user_email'];
?>
<?php require './incl/header.php'; ?>
   <main class="container">
      <h1>About me</h1>
      <form method="POST">
         <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" placeholder="Name" value="<?php echo $name; ?>">
         </div>
         <button type="submit" class="btn btn-primary">Submit</button> or <a href="./">Go back to Homepage</a>
      </form>
      <div style="margin-bottom: 600px"></div>
   </main>
<?php require './incl/footer.php'; ?>