<?php
    session_start();
    $_SESSION["location"] = "blog";
?>
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
        <?php
          if(isset($_SESSION['user']) && $_SESSION['priv']==1){
              echo '<a href="editpost.php?id='. $_GET["id"] . '"><button type="button" class="btn btn-warning">Editovat příspěvek</button></a>
              <a href="deletepost.php?id='. $_GET["id"] . '"><button type="button" class="btn btn-warning">Smazat příspěvek</button></a><br><br>';
          } 
        ?>
        <p>
            <?php echo $blog['text'] ?>
        </p>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>