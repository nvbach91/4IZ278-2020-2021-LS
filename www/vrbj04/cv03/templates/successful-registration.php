<?php require __DIR__ . "/_header.php" ?>
<div class="alert alert-success">
    Registration successfully submitted!
</div>

<div class="row">
    <div class="col-sm-12 col-md-2">
        <div class="card">
            <img src="<?= $_POST["avatarURL"] ?>" class="card-img-top">
        </div>
    </div>
    <div class="col-sm-12 col-md-10">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Player profile</h4>

                <hr>

                <h1><?= $_POST["name"] ?></h1>
                <div class="text-muted">
                    <?= $_POST["gender"] === "m" ? "Male" : "Female" ?> &mdash;
                    <?= $_POST["email"] ?> &mdash;
                    <?= $_POST["phone"] ?>
                </div>

                <hr>

                <small>Deck</small>
                <h1 class="text-primary"><?= $_POST["deckName"] ?></h1>
                <div>Contains <?= $_POST["deckSize"] ?> cards</div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . "/_footer.php" ?>
