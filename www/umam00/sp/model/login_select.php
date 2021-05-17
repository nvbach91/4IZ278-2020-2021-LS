<?php
            $email = $_POST["email"];
            $password = hash('sha256', $_POST["password"]);
            include ('model/pdo.php');
            $sql = "SELECT email FROM USERS WHERE email=? AND pass=?";
            $stmt = $conn->prepare($sql); 
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
?>