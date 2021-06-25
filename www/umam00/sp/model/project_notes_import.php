<?php
include ('model/pdo.php');
$project_id = $_GET['projects'];
$sql = "SELECT id_note, name, content, date_of_creation FROM notes where project_id = ? order by date_of_creation desc";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
?>