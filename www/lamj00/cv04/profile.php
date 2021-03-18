<?php
include './logic/logic_fetch.php'; 
$email =htmlspecialchars(trim(($_GET['email'])));
$user = fetchUser($email);

?>
<?php include './includes/head.php'; ?>
<body>
<main>
    <?php include './includes/navigation.php'; ?>
    <h1>Profile</h1>
    <div>Your name: <?php echo $user["name"]?></div>
    <div>Your email: <?php echo  $email?></div>
</main>
</body>
<?php require './hotreloader.php'; ?>