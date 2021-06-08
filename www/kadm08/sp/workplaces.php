<?php
session_start();

require __DIR__ . '/adminRequired.php';
require_once __DIR__ . '/lib/WorkplaceDB.php';


$workplaceDB = new WorkplaceDB();
$workplaces = $workplaceDB->fetchAllItems();


?>


<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <h1>Workplaces</h1>
    <ul>
        <a class="btn btn-primary" href="newWorkplace.php">Add new workplace</a>
    </ul>
    <?php if (!empty($workplaces)) : ?>
        <table class="tbl-cart" cellpadding="10" cellspacing="1" style="border-collapse: separate">
            <tbody>
                <tr>
                    <th style="text-align:left;">ID</th>
                    <th style="text-align:right;">Name</th>
                    <th style="text-align:right;">Price per day</th>
                    <th style="text-align:right;">Active</th>
                </tr>
                <?php foreach ($workplaces as $workplace) : ?>
                    <tr>
                        <td style="text-align:right;"><?php echo $workplace["ws_id"]; ?></td>
                        <td style="text-align:right;"><?php echo $workplace["name"]; ?></td>
                        <td style="text-align:right;"><?php echo $workplace["price_per_day"]; ?></td>
                        <td style="text-align:right;"><?php if ($workplace["active"] == 0) {
                                                            echo "inactive";
                                                        } else {
                                                            echo "active";
                                                        } ?></td>
                        <td>
                            <a class="btn btn-light" href="editWorkplace.php?ws_id=<?php echo $workplace['ws_id'] ?>">Edit</a>
                        </td>
                        <td>
                            <form action="removeWorkplace.php?ws_id=<?php echo $workplace['ws_id'] ?>" method="POST">
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                        <td>
                            <form action="changeActive.php?ws_id=<?php echo $workplace['ws_id'] ?>" method="POST">
                                <?php if ($workplace["active"] == 0) { ?>
                                    <button type="submit" class="btn btn-secondary">Activate</button>
                                <?php    } else { ?>
                                    <button type="submit" class="btn btn-success">Deactivate</button>
                                <?php    } ?>

                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <h5>No worplaces yet</h5>
    <?php endif; ?>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>