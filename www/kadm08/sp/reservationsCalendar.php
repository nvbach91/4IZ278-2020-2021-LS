<?php
session_start();

require __DIR__ . '/adminRequired.php';
require_once __DIR__ . '/lib/ReservationDB.php';


$reservationDB = new ReservationDB();
$reservations = $reservationDB->fetchByWorkplace($_GET['ws_id'], date('Y-m-d', strtotime(date('Y-m-1'))), date("Y-m-t", strtotime(date("Y-m-d"))));

function createDateRangeArray($strDateFrom, $strDateTo)
{
    $aryRange = [];

    $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
    $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

    if ($iDateTo >= $iDateFrom) {
        array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
        while ($iDateFrom < $iDateTo) {
            $iDateFrom += 86400; // add 24 hours
            array_push($aryRange, date('Y-m-d', $iDateFrom));
        }
    }
    return $aryRange;
}

$daysOfCurrentMonth = createDateRangeArray(date('Y-m-d', strtotime(date('Y-m-1'))), date("Y-m-t", strtotime(date("Y-m-d"))));

if (!empty($reservations)) {
    $daysReservedArr = [];

    foreach ($reservations as $reservation) {
        $daysReservedArr[] = createDateRangeArray($reservation['reservation_start'], $reservation['reservation_end']);
    }

    $daysReserved = call_user_func_array('array_merge', $daysReservedArr);
} else {
    $message = "There are no reservations for this workplace";
}
?>

<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <h1>Workplace calendar</h1>
    <ul>
        <?php if (!empty($message)) {
            echo $message;
        } ?>
    </ul>
    <ul><a href="workplaces.php" class="btn btn-primary">Go back to workplaces</a></ul>
    <br>
    <?php if (!empty($daysReserved)) {  ?>
        <?php echo "<h3> Workplace " . $reservation['reservation_id'] . ": " . $reservation['name'] . "</h3>"; ?></th>
        <br>
        <table class="tbl-cart" cellpadding="5" cellspacing="1" style="border-collapse: separate">
            <tbody>
                <tr class="table table-sm">
                    <?php foreach ($daysOfCurrentMonth as $day) : ?>
                        <th style="text-align:left;"><?php echo $day; ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
            <tbody>
                <tr class="table table-sm">
                    <?php foreach ($daysOfCurrentMonth as $day) : ?>
                        <?php if (in_array($day, $daysReserved)) { ?>
                            <th class="text-danger"> <?php echo "Reserved"; ?></th>
                        <?php } else { ?>
                            <th class="text-success"> <?php echo "Free"; ?></th>
                        <?php }; ?>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    <?php } ?>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>