<?php require_once __DIR__ . '/includes/utils/baseHelper.php'; ?>
<?php require_once __DIR__ . '/config/config.php'; ?>
<?php

$errors = array();

if (isset($_POST['name'])) {

    if (strlen($_POST['name']) < 4) {
        array_push($errors, "Jméno musí mít alespoň 4 znaky");
    }

    if (count($errors) == 0) {
        setcookie("name", uniqid(), time() + 3600);
        header("Location: " . BASE_URL );
    }

}


?>
<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/navigation.php'; ?>

<div class="container py-5">

    <h1>Login</h1>

    <div class="col-4 mt-3 px-0">
        <?php foreach ($errors as $error): ?>
            <div role="alert" class="alert alert-danger"><?php echo $error; ?></div>
        <?php endforeach; ?>
        <form class="row mt-3" method="post">

            <div class="col-auto">
                <input name="name" type="text" class="form-control" id="inputName" placeholder="Name">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Přihlásit se</button>
            </div>
        </form>
    </div>

</div>
<div style="margin-bottom: 600px"></div>

<?php include __DIR__ . '/footer.php'; ?>
