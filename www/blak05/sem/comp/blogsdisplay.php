<?php require __DIR__ . '/../db/blogsDB.php'; ?>
<?php
     $blogsDB = new BlogsDB();
     $blogs = $blogsDB->fetchAll();
?>
            <?php foreach($blogs as $blog): ?>
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-240 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-warning"><?php echo $blog['category']; ?></strong>
                        <h3 class="mb-0"><?php echo $blog['title']; ?></h3>
                        <div class="mb-1 text-muted"><?php echo $blog['date']; ?></div>
                        <p class="card-text mb-auto"><?php echo $blog['description']; ?></p>
                        <a href="read.php?id=<?php echo $blog['ID_Blog']?>" class="link-dark">Číst dále</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                    <img width="330px" height="240px" src="<?php echo $blog['thumbnail']; ?>">
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
