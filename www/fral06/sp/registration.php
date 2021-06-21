<?php
//Head
include "components/head.php";
//Navigation
include "components/nav.php"
?>



<div class="container">
    <main class="form-signin text-center">
        <form action="POST">
            <h1 class="h3 mb-3 fw-normal">Registration page</h1>
            <div>
                <input type="email" aria-label="Email address" class="form-control" id="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <input type="password" aria-label="Password" class="form-control" id="password" placeholder="Password">
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
            <p class="mt-5 mb-3 text-muted">© 2021</p>
        </form>
    </main>
</div>

<?php
include "components/foot.php";
?>

