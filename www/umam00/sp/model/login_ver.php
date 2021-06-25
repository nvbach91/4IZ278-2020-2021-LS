<?php
        $ver = $_SESSION["VER"];
        $id = null;
        $sql = "SELECT id_user from users where verification = ?";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("s", $ver);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach($data as $row)
        {
            $id = $row['id_user'];
        }
        $_SESSION["ID"] = $id;
        $stmt->close();
        $conn->close();
?>