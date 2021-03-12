<?php

  require __DIR__ . '../../utils/utils.php';

  $email = $_GET['email'];
  $user = fetchUser($email);

  if (!$user) {
    header('Location: login.php');
    exit();
  }

?>
<?php require '../../components/header.inc.php'; ?>
<h1 class="text-center">Profile</h1>
<h5 class="card-title"><?php echo $user['first_name']; ?></h5>
<h6 class="card-subtitle mb-2 text-muted"><?php echo $user['email']; ?></h6>
<a href="#" class="card-link">Visit website</a>
<a href="#" class="card-link">GitHub profile</a>

<?php require '../../components/footer.inc.php'; ?>
