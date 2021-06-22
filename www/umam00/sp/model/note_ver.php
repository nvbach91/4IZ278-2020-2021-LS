<?php
            include ('model/pdo.php');
            $id = $_SESSION["ID"];
            $note_id= $_GET["note"];
            $sql = "select id_note from notes where id_note =? and user_id =?";
            $stmt = $conn->prepare($sql);
            $stmt -> bind_param("ii",$note_id, $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
?>