<?php
    session_start();
    $_SESSION["location"] = "blog";
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<?php require __DIR__ . '/incl/auth.php'; ?>
<?php require __DIR__ . '/db/blogsDB.php' ?>
<?php
    $error = "";
    if (!empty($_POST)) {

        $date = $_POST['date'];
        $title = $_POST['title'];
        $text = $_POST['text'];
        $thumbnail = $_POST['thumbnail'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        
        $newblogDB = new BlogsDB();
        $blog = $newblogDB->create([$date, $title, $text, $thumbnail, $description, $category]);
        header("Location: blog.php");
    }
?>
<main>
    <div class="container blog text-center">
        <h1>Nový Post</h1>
        <form action="#" method="POST" class="row g-3">
            <div class="col-12">
                <label for="title" class="form-label">Název</label>
                <input type="text" class="form-control" name="title" placeholder="Nový Blog Post">
            </div>
            <div class="col-12">
                <label for="text" class="form-label">Text</label>
                <textarea type="text" class="form-control" name="text" placeholder="co máte na srdci?"></textarea>
            </div>
            <div class="col-md-4">
                <label for="date" class="form-label">Datum</label>
                <input type="text" class="form-control" name="date" placeholder="2021-05-21">
            </div>
            <div class="col-md-4">
                <label for="thumbnail" class="form-label">Thumbnail</label>
                <input type="text" class="form-control" name="thumbnail" placeholder="url">
            </div>
            <div class="col-md-4">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" name="category" placeholder="jde o pivní toulky?">
            </div>
            <div class="col-12">
                <label for="description" class="form-label">Descripce</label>
                <input type="text" class="form-control" name="description" placeholder="O čem píšete?">
            </div>
            <div class="col-12">
                <button class="btn btn-lg btn-outline-dark btn-warning btn-block" type="submit">Publikovat</button>
            </div>
        </form>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>