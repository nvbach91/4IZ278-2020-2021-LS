<?php require __DIR__ . '/database_connection.php';

if (@$_POST) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $img = $_POST['img'];

    var_dump($_POST);

    $sql = "UPDATE " . $tableName . " SET name = :name, price = :price, description = :description, img = :img WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "id" => $id, 
        "name" => $name,
        'price' => $price,
        'description' => $description,
        'img' => $img
    ]);

    header('Location: edit-item.php');

} 

if (@$_GET) {
    $id = @$_GET['id'];
    $sql = "SELECT * FROM " . $tableName . " WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
    $item = $statement->fetch();
} else {
    $success = 'Success';
}
?>

<?php include __DIR__ . '/includes/header.php' ?>
<main>
<?php if (@$_GET || @$_POST): ?>
    <form method="post" action="edit-item.php">
        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-2 col-form-label">Id</label>
            <div class="col-sm-10">
                <input name="id" class="form-control" id="colFormLabel" value="<?php echo $id; ?>" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input name="name" class="form-control" id="colFormLabel" value="<?php echo $item['name']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
                <input name="price" class="form-control" id="colFormLabel" value="<?php echo $item['price']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-10">
                <input name="img" class="form-control" id="colFormLabel" value="<?php echo $item['img']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $item['description']; ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Ok</button>
            </div>
        </div>
    </form>
    <?php else: ?>
        <h1><?php echo $success; ?></h1>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/includes/footer.php' ?>