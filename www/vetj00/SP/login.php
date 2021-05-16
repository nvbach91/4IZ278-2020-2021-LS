<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>
<div class="container-sm">
    <form class="login m-auto">
        <div class="form-group my-2">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group my-2">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary my-2">Submit</button>
    </form>
    <div class="text-center">Don't have an acount? <a href="registration.php">Register Now</a></div>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>