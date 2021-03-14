<?php include __DIR__ . '/lib/usersDb.php'; ?>
<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/includes/navigation.php'; ?>
<main>
    <h1>Users</h1>
    <ul> 
    <?php foreach(fetchUsers() as $user) {
        echo '<li>' . $user['name'] . ', ' . $user['email'] . '</li>';
    }
    ?>
    </ul>
</main>
<?php include __DIR__ . '/includes/foot.php'; ?>