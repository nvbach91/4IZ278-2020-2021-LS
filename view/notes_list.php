<div class="main-container">
        <div class="row main-headline">
            <h1 class="bold">your notes</h1>
        </div>
        <div class="row">
            <?php
                include ('model/pdo.php');
                $id = $_SESSION["ID"];
                $sql = "SELECT name, content FROM notes where user_id = ? order by date_of_creation desc";
                $stmt = $conn->prepare($sql); 
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);
                foreach ($data as $row)
                {
                ?>
                <div class="col-6 col-md-4 col-lg-2  col-offset-2 note">
                    <h2><?php echo $row['name']; ?></h2>
                    <div class="note-body">
                        <p><?php echo substr($row['content'], 0, 100); ?></p>
                    </div>
                </div>
                <?php
                } 
            ?>
        </div>
        <div class="insert-btn" id="insert_note">
            <a href="?add=note"><i class="material-icons">add</i></a>
        </div>
    </div>