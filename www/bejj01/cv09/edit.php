<?php
    require __DIR__ . '/manager-required.php';
    require __DIR__ . '/includes/header.php'; 
    require __DIR__ . '/db.php';

    if(!empty($_GET)) {
        $offset = $_GET['offset'];
        $fetch = "SELECT * FROM goods WHERE id = :id";
        $stmt = $pdo->prepare($fetch);
        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        $good = $stmt->fetch();
    }

    if(!empty($_POST)) {
        $offset = $_POST['offset'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $img = $_POST['img'];
        $description = $_POST['description'];
        $id = $_POST['id'];
        $update = "UPDATE goods SET name=:name, price=:price, img=:img, description=:description WHERE id = :id";
        $stmt = $pdo->prepare($update);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':img', $img);
        $stmt->bindValue(':description', $description);
        $result = $stmt->execute();

        $message = $result 
            ? ["text" => "Record was correctly updated.", "success" => true]
            : ["text" => "Update was not successful!", "success" => false];
    }

?>

<main class="container">
    <h1 class="text-center">Edit Mode</h1>
    <?php if(isset($message)): ?>
        <div class="alert <?php echo $message['success'] ? ' alert-success' : ' alert-danger'; ?>">
            <?php echo $message['text']; ?>
            <p class="text-center">
                <a href="index.php?offset=<?php echo $offset?>">
                    <i class="mr-2 fas fa-arrow-left"></i>Go Back
                </a>
            </p>
        </div>
    <?php endif; ?>

    <form class="edit-form" action="edit.php" method="POST">
        <input value="<?php echo isset($good['id']) ? $good['id'] : @$id; ?>" type="hidden" name="id">
        <input value="<?php echo @$offset; ?>" type="hidden" name="offset">
        <div class="form-group">
            <label for="name">Change Name</label>
            <input value="<?php echo isset($good['name']) ? $good['name'] : @$name; ?>" class="form-control" placeholder="Enter new mango name" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="price">Change Price</label>
            <input type="number" step="0.1" class="form-control" value="<?php echo isset($good['price']) ? $good['price'] : @$price; ?>" placeholder="Enter new price" name="price" id="price">
        </div>
        <div class="form-group">
            <label for="img">Change Image URL</label>
            <input value="<?php echo isset($good['img']) ? $good['img'] : @$img; ?>" class="form-control" placeholder="Enter new image url" name="img" id="img">
        </div>
        <div class="form-group">
            <label for="price">Change Description</label>
            <textarea class="form-control" rows="5" placeholder="Change description" name="description" id="description"><?php echo isset($good['description']) ? $good['description'] : @$description; ?></textarea>
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
    <a class="btn btn-danger mt-3 mb-4" href="index.php?offset=<?php echo $offset?>">
        <i style="padding-right: 5px;" class="fas fa-ban"></i>Cancel
    </a>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>