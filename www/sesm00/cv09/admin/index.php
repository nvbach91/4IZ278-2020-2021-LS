<?php require_once __DIR__ . '/../includes/utils/baseHelper.php'; ?>
<?php require_once __DIR__ . '/../config/config.php'; ?>
<?php require_once __DIR__ . '/../includes/classes/ProductsDB.php'; ?>
<?php

if (!isset($_COOKIE['user'])) {
    header("Location: " . BASE_URL . "login.php");
    die();
}

verifyUserAccess(PRIVILEGE_MANAGER | PRIVILEGE_ADMINISTRATOR);

$messages = array();

$productsDB = new ProductsDB();

$isEditing = false;
if (isset($_POST['action'])) {
    if ($_POST['action'] == "editPrepare") {
        $isEditing = true;
        $productID = $_POST['id'];
        $searchedProducts = $productsDB->fetchBy(array('where' => array('id' => $productID)));
        if (count($searchedProducts) > 0) {
            $editedProduct = $searchedProducts[0];
        } else {
            $isEditing = false;
            array_push($messages, array('type' => 'danger', 'text' => 'Produkt nebyl nalezen'));
        }
    }

    if ($_POST['action'] == "add" || $_POST['action'] == "edit") {

        $validForm = true;
        if (!isset($_POST['name']) || strlen($_POST['name']) <= 3) {
            $validForm = false;
            array_push($messages, array('type' => 'danger', 'text' => "Jméno musí být delší než 3 znaky"));
        }

        if (!isset($_POST['image']) || strlen($_POST['image']) <= 3) {
            $validForm = false;
            array_push($messages, array('type' => 'danger', 'text' => "Obrázek musí být delší než 3 znaky"));
        }

        if (!isset($_POST['price']) || !is_numeric($_POST['price'])) {
            $validForm = false;
            array_push($messages, array('type' => 'danger', 'text' => "Cena musí být číslo"));
        }

        if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
            $validForm = false;
            array_push($messages, array('type' => 'danger', 'text' => "Neplatné ID"));
        }

        if ($_POST['action'] == "add" && $validForm && hasUserAccess(PRIVILEGE_ADMINISTRATOR)) {
            $result = $productsDB->create(
                array(
                    'name' => $_POST['name'],
                    'image' => $_POST['image'],
                    'price' => $_POST['price'],
                )
            );
            if ($result) {
                array_push($messages, array('type' => 'success', 'text' => "Přidání provedeno"));
            } else {
                array_push($messages, array('type' => 'warn', 'text' => Database::INSERT_FAILED));
            }
        } elseif ($_POST['action'] == "edit" && $validForm) {
            $result = $productsDB->update(
                array(
                    'name' => $_POST['name'],
                    'image' => $_POST['image'],
                    'price' => $_POST['price'],
                ),
                array(
                    'id' => $_POST['id']
                )
            );
            if ($result) {
                array_push($messages, array('type' => 'success', 'text' => "Úprava provedena"));
            } else {
                array_push($messages, array('type' => 'warn', 'text' => Database::UPDATE_FAILED));
            }
        }

    }

    if ($_POST['action'] == "delete" && is_numeric($_POST['id']) && hasUserAccess(PRIVILEGE_ADMINISTRATOR)) {
        if ($productsDB->delete(array('id' => $_POST['id']))) {
            array_push($messages, array('type' => 'success', 'text' => "Výmaz proveden"));
        } else {
            array_push($messages, array('type' => 'warn', 'text' => Database::DELETE_FAILED));
        }
    }

}

$products = $productsDB->fetchAll();
if ($products === false) {
    array_push($messages, array('type' => 'warn', 'text' => Database::SELECT_FAILED));
    $products = array();
}

?>
<?php include __DIR__ . '/../header.php'; ?>
<?php include __DIR__ . '/../navigation.php'; ?>

<div class="container py-5">

    <h1>Administrace</h1>

    <div class="mt-2 mb-2">
    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?php echo $message['type']; ?>" role="alert">
            <?php echo $message['text']; ?>
        </div>
    <?php endforeach; ?>
    </div>

    <?php if (hasUserAccess(PRIVILEGE_ADMINISTRATOR)) : ?>
    <ul class="nav nav-pills mb-3">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" href="<?php echo BASE_URL . "admin/"; ?>">Produkty</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="<?php echo BASE_URL . "admin/users.php"; ?>">Uživatelé</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="<?php echo BASE_URL . "admin/world-clock.php"; ?>">Hodiny</a>
        </li>
    </ul>
    <?php endif; ?>

    <?php if (hasUserAccess(PRIVILEGE_ADMINISTRATOR) || (hasUserAccess(PRIVILEGE_MANAGER) && !$isEditing)) : ?>

    <p>
        <button class="btn btn-outline-secondary" type="button" data-toggle="collapse" data-target="#collapseAddProduct" aria-expanded="<?php echo $isEditing ? "true" : "false"; ?>" aria-controls="collapseAddProduct">
            <?php echo $isEditing ? "Úprava produktu" : "Přidání produktu"; ?>
        </button>
    </p>
    <div class="collapse<?php echo $isEditing ? " show" : ""; ?>" id="collapseAddProduct">
        <form class="g-3" method="post">
            <div class="row my-2">
                <div class="col-auto">
                    <input type="text" class="form-control" id="inputName" placeholder="Název" name="name" value="<?php echo $isEditing ? $editedProduct['name'] : ""; ?>">
                </div>
            </div>
            <div class="row my-2">
                <div class="col-auto">
                    <input type="text" class="form-control" id="inputLink" placeholder="Link" name="image" value="<?php echo $isEditing ? $editedProduct['image'] : ""; ?>">
                </div>
            </div>
            <div class="row my-2">
                <div class="col-auto">
                    <input type="number" class="form-control" id="inputPrice" placeholder="Cena" name="price" value="<?php echo $isEditing ? $editedProduct['price'] : ""; ?>">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3"><?php echo $isEditing ? "Upravit" : "Přidat"; ?></button>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $isEditing ? $editedProduct['id'] : "0"; ?>">
            <input type="hidden" name="action" value="<?php echo $isEditing ? "edit" : "add"; ?>">
        </form>
    </div>
    <?php endif; ?>

    <div class="mt-4 vh-100">
        <div class="mh-100 overflow-auto">
            <?php foreach ($products as $product) : ?>
            <div class="card my-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1"><?php echo $product['id']; ?></div>
                        <div class="col-md-3"><?php echo $product['name']; ?></div>
                        <div class="col-md-3">
                            <?php echo $product['image']; ?>
                        </div>
                        <div class="col-md-2"><?php echo $product['price']; ?></div>
                        <div class="col-md-3 text-right">
                            <form method="post" class="d-inline">
                                <input type="hidden" name="action" value="editPrepare">
                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                <button class="btn btn-primary" type="submit">Upravit</button>
                            </form>
                            &nbsp;
                            <?php if (hasUserAccess(PRIVILEGE_ADMINISTRATOR)) : ?>
                            <form method="post" class="d-inline">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                <button class="btn btn-danger" type="submit">Smazat</button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<?php include __DIR__ . '/../footer.php'; ?>
