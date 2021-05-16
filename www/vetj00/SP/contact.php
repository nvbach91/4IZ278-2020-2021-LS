<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>
<main class="container-sm">
    <div class="text-center mb-2">
        <h2>Contact us</h2>
    </div>
    <form class="contact m-auto">
        <div class="form-group my-2">
            <label for="exampleInputName1">Name</label>
            <input type="name" class="form-control" id="exampleInputName1" placeholder="Enter name">
        </div>
        <div class="form-group my-2">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary my-2">Submit</button>
    </form>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>