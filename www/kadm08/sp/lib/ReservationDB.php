<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class ReservationDB extends Database
{
    public function fetchAllItems()
    {
        $sql = "SELECT * FROM wp_reservation wp
                JOIN client c on wp.client_id = c.client_id
                ORDER BY reservation_start DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchById($reservation_id)
    {
        $sql = "SELECT wp.*, c.name, c.surname, w.name as wp_name FROM wp_reservation wp
            JOIN client c on wp.client_id = c.client_id
            JOIN workplace w on w.ws_id = wp.ws_id
            WHERE reservation_id = :reservation_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['reservation_id' => $reservation_id]);
        return $stmt->fetch();
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

    public function updatePaid($reservation_id, $reservation_paid)
    {
        $sql = "UPDATE wp_reservation SET reservation_paid = :reservation_paid WHERE reservation_id = :reservation_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'reservation_id' => $reservation_id,
            'reservation_paid' => $reservation_paid
        ]);
    }

    public function createItem($start, $end, $total_price, $client_id, $ws_id, $days_of_reservation)
    {
        $sql = "INSERT INTO wp_reservation (reservation_created, reservation_start, reservation_end, total_price, client_id, ws_id, days_of_reservation) 
                VALUES (NOW(), :start, :end, :total_price, :client, :ws_id, :days_of_reservation)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "start" => $start,
            "end" => $end,
            "total_price" => $total_price,
            "client" => $client_id,
            "ws_id" => $ws_id,
            "days_of_reservation" => $days_of_reservation
        ]);
    }

    public function getAvailableWorkplace($reservation_end, $reservation_start)
    {
        $sql = "SELECT * FROM workplace 
            WHERE (active = 1) 
            AND ws_id NOT IN 
            (SELECT ws_id FROM wp_reservation 
            WHERE (reservation_start <= :reservation_end) and (reservation_end >= :reservation_start)) 
            ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "reservation_end" => $reservation_end,
            "reservation_start" => $reservation_start
        ]);
        return $stmt->fetchAll();
    }

    public function getAvailableWorkplaceForUpdate($reservation_id, $reservation_end, $reservation_start)
    {
        $sql = "SELECT * FROM workplace 
            WHERE (active = 1) 
            AND ws_id NOT IN 
            (SELECT ws_id FROM (SELECT * FROM wp_reservation WHERE reservation_id != :reservation_id) as temp_table 
            WHERE (reservation_start <= :reservation_end) and (reservation_end >= :reservation_start)) 
            ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "reservation_id" => $reservation_id,
            "reservation_end" => $reservation_end,
            "reservation_start" => $reservation_start
        ]);
        return $stmt->fetchAll();
    }


    public function updateItem($id, $start, $end, $ws_id, $total_price, $days_of_reservation)
    {
        $sql = "UPDATE wp_reservation SET reservation_start = :start, reservation_end = :end, ws_id = :ws_id, total_price = :total_price, days_of_reservation = :days_of_reservation, last_updated = NOW()
        WHERE reservation_id = :reservation_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "reservation_id" => $id,
            "start" => $start, 
            "end" => $end, 
            "ws_id" => $ws_id, 
            "total_price" => $total_price, 
            "days_of_reservation" => $days_of_reservation
        ]);
    }
}

?>