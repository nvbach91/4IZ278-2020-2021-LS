<?php
                $result = sprintf("%s%d", $email, time());
                $ver = hash('sha256', $result);
                $sql = "UPDATE users set verification=? where email=?";
                $stmt = $conn->prepare($sql); 
                $stmt->bind_param("ss", $ver, $email);
                $stmt->execute();
                $stmt->close();
                $conn->close();
?>