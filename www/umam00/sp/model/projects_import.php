<?php
include ('model/pdo.php');
$id = $_SESSION["ID"];
$sql = "SELECT * from projects where user_id = ? order by projects.date_of_creation desc";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);

?>