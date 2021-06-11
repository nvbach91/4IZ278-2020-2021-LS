<?php
session_start();

require __DIR__ . '/adminRequired.php';
require_once __DIR__ . '/lib/ReservationDB.php';

$reservationDB = new ReservationDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation = $reservationDB->fetchById($_GET['reservation_id']);
 
    if ($reservation['reservation_paid'] == 0) {
        $change_paid = $reservationDB->updatePaid($reservation['reservation_id'], 1);
    }else {
        $change_paid = $reservationDB->updatePaid($reservation['reservation_id'], 0);
    }

    header('Location: reservations.php');
}
