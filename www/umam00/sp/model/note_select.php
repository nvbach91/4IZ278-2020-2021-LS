<?php
                include ('model/pdo.php');
                $id = $_SESSION["ID"];
                $id_note = $_GET["note"];
                $_SESSION["NOTE_ID"] = $id_note;
                $sql = "SELECT name, content, date_of_creation FROM notes where user_id = ? and id_note = ?";
                $stmt = $conn->prepare($sql); 
                $stmt->bind_param("ii", $id, $id_note);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);   
?>