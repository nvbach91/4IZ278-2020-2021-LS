<?php
session_start();

require __DIR__ . '/db.php';
require __DIR__ . '/user_required.php';

$reservation = $pdo->prepare("SELECT * FROM wp_reservation WHERE reservation_id = :reservation_id;");
$reservation->execute([
    'reservation_id' => $_GET['reservation_id']
]);
$reservation = $reservation->fetchAll()[0];

if ($reservation['reservation_paid'] == 0) {
$statement = $pdo->prepare("UPDATE wp_reservation SET reservation_paid = 1
                            WHERE reservation_id = :reservation_id;");
$statement->execute(['reservation_id' => $_GET['reservation_id']]);
}

header('Location: reservations.php');  

?>

