<?php require_once __DIR__ . '/../includes/utils/baseHelper.php'; ?>
<?php require_once __DIR__ . '/../config/config.php'; ?>
<?php

if (!isset($_COOKIE['user'])) {
    header("Location: " . BASE_URL . "login.php");
    die();
}

verifyUserAccess(PRIVILEGE_ADMINISTRATOR);

$messages = array();

$usersDB = new UsersDB();

if (isset($_POST['action']) && $_POST['action'] == "editPrivilege") {
    if (is_numeric($_POST['id']) && is_numeric($_POST['privilege'])) {
        $result = $usersDB->update(array('privilege' => $_POST['privilege']), array('id' => $_POST['id']));

        if ($result) {
            array_push($messages, array('type' => 'success', 'text' => 'Změna oprávnění úspěšná'));
        } else {
            array_push($messages, array('type' => 'danger', 'text' => 'Změna oprávnění se nezdařila'));
        }
    }
}

$users = $usersDB->fetchAll();

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


    <ul class="nav nav-pills mb-3">
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="<?php echo BASE_URL . "admin/"; ?>">Produkty</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" href="<?php echo BASE_URL . "admin/users.php"; ?>">Uživatelé</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="<?php echo BASE_URL . "admin/world-clock.php"; ?>">Hodiny</a>
        </li>
    </ul>


    <div class="mt-4 vh-100">
        <div class="mh-100 overflow-auto">
            <?php foreach ($users as $user) : ?>
                <div class="card my-2">
                    <div class="card-body">
                        <form method="post" class="">
                            <div class="row">
                                <div class="col-md-1"><?php echo $user['id']; ?></div>
                                <div class="col-md-3"><?php echo $user['email']; ?></div>
                                <div class="col-md-5">
                                    <select name="privilege" class="custom-select">
                                        <option value="<?php echo PRIVILEGE_CUSTOMER; ?>"<?php echo $user['privilege'] == PRIVILEGE_CUSTOMER ? " selected" : ""; ?>>Zákazník</option>
                                        <option value="<?php echo PRIVILEGE_MANAGER; ?>"<?php echo $user['privilege'] == PRIVILEGE_MANAGER ? " selected" : ""; ?>>Manager</option>
                                        <option value="<?php echo PRIVILEGE_ADMINISTRATOR; ?>"<?php echo $user['privilege'] == PRIVILEGE_ADMINISTRATOR ? " selected" : ""; ?>>Administrátor</option>
                                    </select>
                                </div>
                                <div class="col-md-3 text-right">
                                    <input type="hidden" name="action" value="editPrivilege">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button class="btn btn-primary" type="submit">Upravit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<?php include __DIR__ . '/../footer.php'; ?>
