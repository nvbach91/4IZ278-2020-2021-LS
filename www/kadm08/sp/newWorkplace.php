<?php
session_start();


require __DIR__ . '/db.php';
require __DIR__ . '/user_required.php';

$success = false;

$errors = [];
if (!empty($_POST)) {
    if (!is_numeric($_POST['price'])) array_push($errors, "Price must be a number");
}

if (!empty($_POST) and empty($errors)) {
    $statement = $pdo->prepare("
                         INSERT INTO workplace (name, price_per_day, active) 
                         VALUES (?, ?, ?)                                           
                         ");
    $active = false;
    if (isset($_POST['active'])) {
        $active = true;}
        else {
            $active = false;  
        }

    $statement->execute([
        $_POST['name'],
        $_POST['price'],
        $active,
    ]);
    $success = true;
}
?>


<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <br /><br /><br /><br />
    <h1>Add new item</h1>
    <ul>
        <?php foreach ($errors as $message) : ?>
            <div class="error"><?php echo  $message; ?></div>
        <?php endforeach; ?>
        <?php if ($success) : ?>
            <div class="success">You have successfully added new item</div>
        <?php endif; ?>
    </ul>

    <form method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="name" name="name" class="form-control" id="name" placeholder="">
        </div>
        <div class="form-group">
            <label for="price">Price per day</label>
            <input type="price" name="price" class="form-control" id="price" placeholder="">
        </div>
        <div class="form-check">
            <input type="checkbox" name="active" class="form-check-input" id="active">
            <label class="form-check-label" for="active">Active</label>
        </div>
        <div class="btn-wrapper text-center justify-content-between">
            <button type="submit" class="btn btn-primary">Add</button>
            <a href="workplaces.php" class="btn btn-primary">Go to workplaces</a>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>