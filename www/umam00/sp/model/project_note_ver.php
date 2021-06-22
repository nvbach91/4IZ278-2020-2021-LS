<?php
            include ('model/pdo.php');
            $id = $_GET["projects"];
            $note_id= $_GET["proj_note"];
            $sql = "select id_note from notes where id_note =? and project_id =?";
            $stmt = $conn->prepare($sql);
            $stmt -> bind_param("ii",$note_id, $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
?>