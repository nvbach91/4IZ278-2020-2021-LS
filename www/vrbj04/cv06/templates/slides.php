<?php /** @var array $slides */ ?>

<?php if (!empty($slides)): ?>
    <h1>Akční nabídka</h1>

    <div class="m5 px-5">
    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($slides as $index => $slide): ?>
                <div class="carousel-item <?= $index === 0 ? "active" : "" ?>">
                    <img src="<?= $slide["image_url"] ?>" class="d-block w-100" alt="<?= $slide["name"] ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="bg-dark"><?= $slide["name"] ?></h1>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    </div>
<?php endif; ?>