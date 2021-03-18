<?php
include './logic/logic_fetch.php'; 
$users =fetchUsers();

?>
<?php include './includes/head.php'; ?>
<body>
<main>
    <?php include './includes/navigation.php'; ?>
    <h1 id="center">Users</h1>
    <div class="row justify-content-center">
    <ul>
        <?php foreach($users as $user):?>
                    <div ><?php echo $user["email"] ."  ". $user["name"] ."  ". $user["password"];?></div>
        <?php endforeach; ?>
    </ul>
    </div>
    
</main>
</body>
<?php require './hotreloader.php'; ?>