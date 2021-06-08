<?php
session_start();


require __DIR__ . '/adminRequired.php';
require_once __DIR__ . '/lib/WorkplaceDB.php';


$success = false;

$errormessages = [];
if (!empty($_POST)) {
    if (!is_numeric($_POST['price'])) array_push($errormessages, "Price must be a number");
}

if (!empty($_POST) and empty($errormessages)) {

    $active = false;
    if (isset($_POST['active'])) {
        $active = true;
    } else {
        $active = false;
    }

    try {
        $workplaceDB = new WorkplaceDB();
        $workplace = $workplaceDB->createItem(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['price']), $active);
        $success = true;
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            array_push($errormessages,   'This name is already taken. Try a different one.');
        }
    }
}
?>


<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <h1>Add new item</h1>
    <ul>
        <?php foreach ($errormessages as $message) : ?>
            <div class="error"><?php echo  $message; ?></div>
        <?php endforeach; ?>
        <?php if ($success) : ?>
            <div class="success" style="color:green;">You have successfully added new item</div>
        <?php endif; ?>
    </ul>

    <form method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="">
        </div>
        <div class="form-group">
            <label for="price">Price per day</label>
            <input type="text" name="price" class="form-control" id="price" placeholder="">
        </div>
        <div class="form-check">
            <input type="checkbox" name="active" class="form-check-input" id="active">
            <label class="form-check-label" for="active">Active</label>
        </div>
        <div class="btn-wrapper text-center justify-content-between">
            <button type="submit" class="btn btn-primary">Add</button>
            <a href="workplaces.php" class="btn btn-primary">Go to workplaces</a>
        </div>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>