<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>
<div class="container-sm">
    <form class="registration m-auto">
        <div class="form-group my-2">
            <label for="exampleInputName1">Name</label>
            <input type="name" class="form-control" id="exampleInputName1" placeholder="Enter name">
        </div>
        <div class="form-group my-2">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group my-2">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group my-2">
            <label for="exampleInputPassword2">Confirm password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password again">
        </div>
        <button type="submit" class="btn btn-primary my-2">Submit</button>
    </form>
    <div class="text-center">Already have an acount? <a href="login.php">Log in</a></div>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>