<?php
require "db.php";
$new_item = $_POST;
$isSubmitted = !empty($_POST);
$success = false;

$errors = [];
if(! empty($new_item)){
    if(!is_numeric($new_item['price'])) array_push($errors,"Price must be number");
    foreach ($new_item as $key => $value){
        if(empty($value)) array_push($errors,"$key is empty");
    }
}

if($isSubmitted and empty($errors)){
    // insert into database
    $statement = $db -> prepare("
                         INSERT INTO `goods` ( `name`, `price`, `description`, `img`) VALUES 
                         (
                          ? , ? , ?,?
                         )                                           
                         ");
    $statement->execute(array($new_item['name'], $new_item['price'] ,$new_item['description'] ,$new_item['img'] ));
    $success = true;
}

?>
<?php require './incl/header.php'; ?>
<?php include './incl/navbar.php'; ?>
    <main class="container">
        <h1>Create item</h1>
        <ul>
            <?php foreach($errors as $msg):?>
                <div class="error"><?php echo  $msg;?></div>
            <?php endforeach; ?>
            <?php if($success):?>
                <div class="success">You have successfully created item</div>
            <?php endif; ?>
        </ul>

        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" id="name" name="name" placeholder="Name">
                <label for="name">Price</label>
                <label for="price"></label><input class="form-control" id="price" name="price" placeholder="Price">
                <label for="name">Description</label>
                <label for="description"></label><input class="form-control" id="description" name="description" placeholder="Description">
                <label for="name">Img url</label>
                <label for="img"></label><input class="form-control" id="img" name="img" placeholder="Img url"/>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div style="margin-bottom: 600px"></div>
    </main>
<?php require './incl/footer.php'; ?>