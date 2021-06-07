<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class ReservationDB extends Database
{
    public function fetchAllItems()
    {
        $sql = "SELECT * FROM wp_reservation wp
                JOIN client c on wp.client_id = c.client_id
                ORDER BY reservation_id ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchByClient($client_id)
    {
        $sql = "SELECT wp.reservation_id, w.name, wp.reservation_start, wp.reservation_end, wp.reservation_created, wp.total_price, wp.reservation_paid  
            FROM wp_reservation wp 
            JOIN client c on wp.client_id = c.client_id
            JOIN workplace w on w.ws_id = wp.ws_id
            WHERE wp.client_id = :client_id 
            ORDER BY reservation_id ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['client_id' => $client_id]);
        return $stmt->fetchAll();
    }

    public function deleteItem($reservation_id)
    {
        $sql = "DELETE FROM wp_reservation WHERE reservation_id = :reservation_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['reservation_id' => $reservation_id]);
    }

}

?>