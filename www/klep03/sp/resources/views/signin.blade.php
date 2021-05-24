@include('includes.element-head')



<form id="signInForm" class="signForm" action="/signin/submit" method="POST">
    <h1>Sign In!</h1>
    @csrf

    <div class="mb-3" style="margin-top: 20px;">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input name="email" type="email" class="form-control" id="signInEmail" aria-describedby="emailHelp" value="<?php
        echo (isset($email)) ?
      htmlspecialchars($email) : '';
        ?>">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input name="password" type="password" class="form-control" id="signInPassword">
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
</form>

@include('includes.element-foot')
