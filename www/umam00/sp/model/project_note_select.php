<?php
                include ('model/pdo.php');
                $proj_id = $_GET["projects"];
                $id_note = $_GET["proj_note"];
                $_SESSION["NOTE_ID"] = $id_note;
                $_SESSION["PROJ_ID"] = $proj_id ;
                $sql = "SELECT name, content, date_of_creation FROM notes where project_id = ? and id_note = ?";
                $stmt = $conn->prepare($sql); 
                $stmt->bind_param("ii", $proj_id , $id_note);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);   
?>