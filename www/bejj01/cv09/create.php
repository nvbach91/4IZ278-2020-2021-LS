<?php
    require __DIR__ . '/manager-required.php';
    require __DIR__ . '/includes/header.php'; 
    require __DIR__ . '/db.php';

    if(!empty($_GET)) {
        $offset = $_GET['offset'];
    }

    if(!empty($_POST)) {
        $offset = $_POST['offset'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $img = $_POST['img'];
        $description = $_POST['description'];
        $update = "INSERT INTO goods (name, price, description, img) VALUES(:name, :price, :description, :img)";
        $stmt = $pdo->prepare($update);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':img', $img);
        $stmt->bindValue(':description', $description);
        $result = $stmt->execute();
        
        if ($result) {
            $message = ["text" => "Record was correctly created.", "success" => true];
        }
        else {
            $message = ["text" => "Insert was not successful!", "success" => false];
        }
    }

?>

<main class="container">
    <h1 class="text-center">Add new mango</h1>
    <?php if(isset($message)): ?>
        <div class="alert <?php echo $message['success'] ? ' alert-success' : ' alert-danger'; ?>">
            <?php echo $message['text']; ?>
            <p class="text-center">
                <a href="index.php">
                    <i class="mr-2 fas fa-arrow-left"></i>Go Back
                </a>
            </p>
            <p class="text-center">
                <a href="create.php?offset=<?php echo @$offset; ?>">
                    <i class="mr-2 fas fa-plus"></i>
                    <?php echo $message['success'] ? 'Add another one' : 'Try Again'; ?>
                </a>
            </p>
        </div>
    <?php else: ?>
        <form method="POST">
            <input value="<?php echo @$offset; ?>" type="hidden" name="offset">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" placeholder="Enter new mango name" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.1" class="form-control" placeholder="Enter new price" name="price" id="price">
            </div>
            <div class="form-group">
                <label for="img">Image URL</label>
                <input class="form-control" placeholder="Enter new image url" name="img" id="img">
            </div>
            <div class="form-group">
                <label for="price">Description</label>
                <textarea class="form-control" rows="5" placeholder="Change description" name="description" id="description"></textarea>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
        <a class="btn btn-danger mt-3 mb-4" href="index.php?offset=<?php echo @$offset?>">
            <i style="padding-right: 5px;" class="fas fa-ban"></i>Cancel
        </a>
    <?php endif; ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>