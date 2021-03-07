<?php include './includes/header.php' ?>
<?php require './requires/validation.php' ?>

<?php if((!$isSubmitted) || (!empty($errorMessages))) : ?>
    <main class="main">
        <div class="form-wrapper">
            <h1 class="form-title">Create account</h1>

            <?php if ($isSubmitted): ?>
                <?php if (!empty($errorMessages)): ?>
                    <?php foreach($errorMessages as $alert): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $alert?>
                        </div>
                    <?php endforeach; ?>
                
                <?php endif; ?>
            <?php endif; ?>


            <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="">
                <div class="mb-3">
                    <label for="inputName" class="form-label">Name</label>
                    <input class="form-control" name="name" id="inputName" value="<?php echo isset($name) ?$name : ""; ?>" placeholder="Tom Hanks">
                </div>
                
                <div class="gender-wrapper">                    
                    <div class="form-check form-gender">
                        <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female" checked <?php echo isset($gender) && $gender === 'Female' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="genderFemale"> Female </label>
                    </div>
                    <div class="form-check form-gender">
                        <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male" <?php echo isset($gender) && $gender === 'Male' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="genderMale"> Male </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="inputEmail" class="form-label">E-mail</label>
                    <input class="form-control" name="email"  id="inputEmail" value="<?php echo isset($email) ?$email : ""; ?>" placeholder="hanks@gmail.com">
                </div>

                <div class="mb-3">
                    <label for="inputPhone" class="form-label">Phone</label>
                    <input class="form-control" name="phone"  id="inputPhone" value="<?php echo isset($phone) ?$phone : ""; ?>" placeholder="+420777888999">
                </div>

                <div class="mb-3">
                    <label for="inputImage" class="form-label">Avatar</label>
                    <input class="form-control" name="image"  id="inputImage" value="<?php echo isset($image) ?$image : ""; ?>" placeholder="https://cs16planet.ru/steam-avatars/images/avatar1833.jpg">
                </div>

                <div class="mb-3">
                    <label for="inputDeckName" class="form-label">Name of deck</label>
                    <input class="form-control" name="deck"  id="inputDeckName" value="<?php echo isset($deck) ?$deck : ""; ?>" placeholder="Miracle">
                </div>

                <div class="mb-3">
                    <label for="inputCount" class="form-label">Number of cards</label>
                    <input class="form-control" name="count"  id="inputCount" value="<?php echo isset($count) ?$count : ""; ?>" placeholder="54">
                </div>

                <button type="submit" class="btn btn-primary form__btn">Submit</button>
            </form>
        </div>
    </main>
<?php endif; ?>


<?php if(($isSubmitted) && (empty($errorMessages))): ?>
    <main class="main">
        <div class="form-wrapper">
            <h1 class="form-title"> You have submitted the form </h1>
        </div>
    </main>
    <?php 
        mail($email, "Confirmation", "Thank you, your form was submitted!"); 
    ?>
<?php endif; ?>


<?php include './includes/footer.php' ?>