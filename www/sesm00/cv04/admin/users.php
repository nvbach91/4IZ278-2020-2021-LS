<?php
require __DIR__ . '/../includes/core.php';
include __DIR__ . '/../includes/head.php';
//include __DIR__ . '/../includes/navigation.php';

$users = fetchUsers();

?>

<div class="h-100 mt-5 pt-3 mx-3">
    <?php foreach ($users as $user): ?>
    <div class="card w-100 my-2">
        <div class="card-body">
            <?php echo $user['name'] . ", " . $user['email'] . ", " . $user['password']; ?>
        </div>
    </div>
    <?php endforeach;?>
</div>

<?php include __DIR__ . '/../includes/foot.php'; ?>
