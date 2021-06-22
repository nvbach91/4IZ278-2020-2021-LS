<?php
include ('model/pdo.php');
$id = $_SESSION["ID"];
$sql = "SELECT id_note, name, content, date_of_creation FROM notes where user_id = ?  and project_id = 0 order by date_of_creation desc";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
?>