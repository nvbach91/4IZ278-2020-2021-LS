<?php require './incl/header.php'; ?>
<?php include './incl/navbar.php'; ?>
<div>
  <form>
    <div>
      <label>Email address</label>
      <input type="email" id="exampleInputEmail1" placeholder="Your email">
    </div>
    <div>
      <label">Password</label>
        <input type="password" placeholder="Your password">
    </div>
    <button type="submit"">Login</button>
  </form>
  <div>Don't have an acount? <a href=" registration.php">Register Now</a>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>