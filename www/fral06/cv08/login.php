<?php
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {
        if (strlen($_POST['name']) < 4) {
            array_push($errors, "Name has to have at least 3 characters");
        }
       else {
           setcookie("name", $_POST['name'], time() + 3600); # ted + 3600 sekund = 1 hodina
           header('Location: index.php');
           exit();
        }
    }
}
//Head
include "includes/head.php";
//Navigation
include "includes/navigation.php"
?>
<!-- Page Content -->
<main class="container signin">
    <div class="signin__wrapper ">
        <h1 class="text-center mb-3">Login</h1>
        <?php foreach ($errors as $error): ?>
            <div role="alert" class="alert alert-danger"><?php echo $error; ?></div>
        <?php endforeach; ?>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" id="name" name="name" placeholder="Name">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>






<?php
//Footer
include "includes/footer.php";
//Foot
include "includes/foot.php";
?>

