<?php
session_start();

require __DIR__ . '/adminRequired.php';
require_once __DIR__ . '/lib/WorkplaceDB.php';

$success = false;

$errors = [];
$workplaceDB = new WorkplaceDB();


if (!empty($_POST)) {
    if (!is_numeric($_POST['price'])) array_push($errors, "Price must be a number");
}

if ('POST' == $_SERVER['REQUEST_METHOD'] and empty($errors)) {

    $last_updated_at = $workplaceDB->fetchLastUpdated($_GET['ws_id']);

    if ($_SESSION[$_GET['ws_id'] . '_last_updated_at'] != $last_updated_at) {
        die(array_push($errors, "The product was updated by someone else in the meantime!"));
    }

    $updateWorkplace = $workplaceDB->updateItem($_GET['ws_id'], htmlspecialchars($_POST['name']), htmlspecialchars($_POST['price']));

    $success = true;
}

$workplace = $workplaceDB->fetchById($_GET['ws_id']);

$_SESSION[$workplace['ws_id'] . '_last_updated_at'] = $workplace['last_updated_at'];


?>


<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <h1>Edit a workplace</h1>
    <ul>
        <?php foreach ($errors as $message) : ?>
            <div class="error"><?php echo  $message; ?></div>
        <?php endforeach; ?>
        <?php if ($success) : ?>
            <div class="success" style="color:green;">You have successfully edited an workplace</div>
        <?php endif; ?>
    </ul>
    <form method="POST">
        <div class="form-group">
            <label for="id">ID</label>
            <input readonly class="form-control" id="id" name="id" value="<?= $workplace['ws_id'] ?>" />
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" value="<?= $workplace['name'] ?>" />
            <label for="price">Price</label>
            <label for="price"></label><input class="form-control" id="price" name="price" value="<?= $workplace['price_per_day'] ?>" />
        </div>
        <div class="btn-wrapper text-center justify-content-between">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="workplaces.php" class="btn btn-primary">Go to workplaces</a>
        </div>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>