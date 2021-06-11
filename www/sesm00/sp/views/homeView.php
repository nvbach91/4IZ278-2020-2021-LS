<?php include __DIR__ . '/../components/header.php'; ?>
<?php include __DIR__ . '/../components/navigation.php'; ?>
<?php
$this->msgs = array_merge($this->msgs, $cartMsgs);
?>

    <div class="container my-2">
        <h1>Česká dálnice CZ</h1>

        <?php foreach ($this->msgs as $msg) : ?>
            <div class="alert alert-<?php echo $msg['type']; ?> alert-dismissible fade show mt-4" role="alert">
                <?php echo $msg['msg']; ?>
                <?php if (isset($_GET['err']) && ($_GET['err'] == "gvf" || $_GET['err'] == "gme")) : ?>
                    <a href="<?php echo getBaseUrl(); ?>" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                <?php else : ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <?php require 'views/sliderView.php'; ?>


        <div>
            <?php foreach ($this->categories as $category): ?>
            <div class="mt-2">
                <h2><?php echo htmlspecialchars($category->name); ?></h2>
                <div class="row">
                    <?php foreach ($category->getProducts() as $product): ?>
                    <div class="col-4 p-2">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo htmlspecialchars($product->name); ?></h4>
                                <?php if ($product->type == 1): ?>
                                    <p class="card-text"><?php echo htmlspecialchars($product->description); ?></p>
                                <?php endif; ?>
                                <strong class="mb-3 d-block"><?php echo $product->getFormatedPrice() . " " . CURRENCY; ?></strong>
                                <?php if ($this->userLoggedIn): ?>
                                    <form method="post">
                                        <input type="hidden" name="id" value="<?php echo $product->getId(); ?>">
                                        <input type="hidden" name="action" value="addToCart">
                                        <button class="btn btn-primary w-100" type="submit">Přidat do košíku</button>
                                    </form>
                                <?php else: ?>
                                    <a href="login" class="btn btn-primary w-100">Přihlásit se</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>



<?php include __DIR__ . '/../components/footer.php'; ?>