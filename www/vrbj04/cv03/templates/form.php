<?php require __DIR__ . "/_header.php" ?>
<div class="row">
    <div class="card col-sm-12 col-md-6">
        <div class="card-body">
            <form action="index.php" method="post" class="form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text"
                           class="form-control <?= in_array("name", $violations) ? 'is-invalid' : '' ?>"
                           value="<?= $_POST["name"] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender"
                            class="form-control <?= in_array("gender", $violations) ? 'is-invalid' : '' ?>">
                        <option value="m" <?= (($_POST["gender"] ?? "") == "m") ? "selected" : "" ?>>Male</option>
                        <option value="f" <?= (($_POST["gender"] ?? "") == "f") ? "selected" : "" ?>>Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="text"
                           class="form-control <?= in_array("email", $violations) ? 'is-invalid' : '' ?>"
                           value="<?= $_POST["email"] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input name="phone" type="text"
                           class="form-control <?= in_array("phone", $violations) ? 'is-invalid' : '' ?>"
                           value="<?= $_POST["phone"] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label for="avatarURL">Avatar (URL)</label>
                    <input name="avatarURL" type="text"
                           class="form-control <?= in_array("avatarURL", $violations) ? 'is-invalid' : '' ?>"
                           value="<?= $_POST["avatarURL"] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label for="deckName">Deck name</label>
                    <input name="deckName" type="text"
                           class="form-control <?= in_array("deckName", $violations) ? 'is-invalid' : '' ?>"
                           value="<?= $_POST["deckName"] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label for="deckSize">Deck size</label>
                    <input name="deckSize" type="text"
                           class="form-control <?= in_array("deckSize", $violations) ? 'is-invalid' : '' ?>"
                           value="<?= $_POST["deckSize"] ?? '' ?>">
                </div>

                <hr>
                <button type="submit" class="btn btn-primary">Submit registration</button>
            </form>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 text-center">
        <img src="https://i.pinimg.com/originals/a8/68/68/a8686855948a529d199ec669fce01225.gif" alt="Card">
    </div>
</div>
<?php require __DIR__ . "/_footer.php" ?>
