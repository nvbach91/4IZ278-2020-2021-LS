<?php $root = ".." ?>
<?php require __DIR__ . "/../layout/_header.php" ?>

<h1 class="spicy">Fellow meme enjoyers</h1>

<table class="table table-dark">
    <thead>
    <tr>
        <th>Username</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td>
                <b class="spicy">
                <?= $user->username ?>
                </b>
            </td>
            <td>
                <?= $user->email ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . "/../layout/_footer.php" ?>
