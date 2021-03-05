    <?php include __DIR__ . '/includes/head.php' ?>

    <?php
    $invalidInputs = [];

    $isSubmitted = !empty($_GET); //if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = "";

    if ($isSubmitted) {
        $name =  htmlspecialchars(trim($_GET['name']));
        $gender = htmlspecialchars(trim($_GET['gender']));
        $email =  htmlspecialchars(trim($_GET['email']));
        $phone = htmlspecialchars(trim($_GET['phone']));
        $avatar =  htmlspecialchars(trim($_GET['avatar']));

        //Name
        if (empty($name)) {
            array_push($invalidInputs, 'Name is not filled');
        }

        //mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($invalidInputs, 'Email is not valid');
        }

        //Phone
        if (!preg_match("/^[0-9]{9}$/", $phone)) {
            array_push($invalidInputs, 'Phone number is not valid');
        }

        //url
        if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
            array_push($invalidInputs, 'URL is not valid');
        }

        if (!count($invalidInputs)) {
            $message = 'You have sucessfully logged into tournament';
        }
    }

    ?>

    <main>
        <h1>Card fest registration</h1>
        <form class="form-signup">
            <?php if ($isSubmitted) : ?>
                <?php if (!empty($invalidInputs)) : ?>
                    <div class="alert alert-danger">
                        <?php foreach ($invalidInputs as $msg) : ?>
                            <p><?php echo $msg; ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                    <?php if ($message) : ?>
                        <div class="alert-success">
                            <h3><?php echo $message; ?></h3>
                        </div>
                        <img width="200" height="200" src="<?php echo $avatar ?>" alt="avatar">
                    <?php endif; ?>
                <?php endif; ?>
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
                </div>
                <div class="form-group">
                    <label>Gender</label><br>
                    <select class="form-control" name="gender" id="gender">
                        <option value="Male" <?php if (isset($gender) && $gender == 'Male')
                                                    echo ' selected="selected"';
                                                ?>>Male</option>
                        <option value="Female" <?php if (isset($gender) && $gender == 'Female')
                                                    echo ' selected="selected"';
                                                ?>>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
                </div>
                <div class="form-group">
                    <label>Avatar URL</label>
                    <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </main>

    <?php include __DIR__ . '/includes/foot.php' ?>