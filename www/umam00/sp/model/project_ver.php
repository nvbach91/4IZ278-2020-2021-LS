<?php

            if(isset($_GET['projects']) and $_GET['projects']!= null)
            {
                include ('model/pdo.php');
                $id = $_SESSION["ID"];
                $project_id = $_GET['projects'];
    
                $sql = "select id_project from projects where user_id = ? and id_project = ?";
                $stmt = $conn->prepare($sql);
                $stmt -> bind_param("ii",$id , $project_id );
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                if(!$data)
                {
                    $sql = "select id from user_to_project where id_user = ? and id_project = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt -> bind_param("ii",$id , $project_id );
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);

                    if(!$data)
                    {
                        include ('controller/reset_page.php');
                    }
                }
            }
?>