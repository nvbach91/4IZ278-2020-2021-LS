<?php
    session_start();
    $_SESSION["location"] = "blog";
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<?php 
    require __DIR__ . '/incl/auth.php';
    require __DIR__ . '/db/blogsDB.php'; 

    if (!empty($_GET)) {
        $cislo = $_GET["id"];
        $blogsDB = new BlogsDB();
        $blogs = $blogsDB->fetch($cislo);

        if(!empty($_POST)){
            $date = $_POST['date'];
            $title = $_POST['title'];
            $text = $_POST['text'];
            $thumbnail = $_POST['thumbnail'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $updateDB = new BlogsDB();
            $update = $updateDB->update([$date, $title, $text, $thumbnail, $description, $category, $cislo]);
            Header("Location: blog.php");
        }
    }else{
        Header("Location: index.php");
    }

?>
<main>
    <div class="container blog text-center">
        <h1>Editovat článek <?php echo $_GET["id"]?>.</h1>
        <form action="#" method="POST" class="row g-3">
        <div class="col-12">
            <label for="title" class="form-label">Název</label>
            <input type="text" class="form-control" name="title" value="<?php echo $blogs['title'];?>">
        </div>
        <div class="col-12">
            <label for="text" class="form-label">Text</label>
            <textarea type="text" class="form-control" name="text"><?php echo $blogs['text'];?></textarea>
        </div>
        <div class="col-md-4">
            <label for="date" class="form-label">Datum</label>
            <input type="text" class="form-control" name="date" value="<?php echo $blogs['date'];?>">
        </div>
        <div class="col-md-4">
            <label for="thumbnail" class="form-label">Thumbnail</label>
            <input type="text" class="form-control" name="thumbnail" value="<?php echo $blogs['thumbnail'];?>">
        </div>
        <div class="col-md-4">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" name="category" value="<?php echo $blogs['category'];?>">
        </div>
        <div class="col-12">
            <label for="description" class="form-label">Descripce</label>
            <input type="text" class="form-control" name="description" value="<?php echo $blogs['description'];?>">
        </div>
        <div class="col-12">
            <button class="btn btn-lg btn-outline-dark btn-warning btn-block" type="submit">Uložit novou verzi</button>
        </div>
        </form>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>