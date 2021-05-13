<?php require __DIR__ . '/db/blogsDB.php' ?>
<?php
    $id = $_GET['id'];

    $blogsDB = new BlogsDB();
    $blog = $blogsDB->fetch($id);
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main>
    <div class="container blog text-center">
        <h1><?php echo $blog['title'] ?></h1>
        <p><?php echo $blog['date'] ?> - napsal <?php echo $blog['name'] ?></p>
        <img src="<?php echo $blog['thumbnail'] ?>">
        <p>
        <?php echo $blog['text'] ?>
        </p>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>