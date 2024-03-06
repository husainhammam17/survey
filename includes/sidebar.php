<style>
  .card-container {
    margin: 5rem auto 5rem auto;
  }
</style>
<div class="card-container col-md-4">

  <div class="card my-4">

    <?php if (isset($_SESSION['user_role'])) : ?>

      <h5 class="card-header">Logged in as <?php echo $_SESSION['username']; ?></h5>
      <span class="input-group-btn text-center">
        <a href="includes/logout.php" class="btn btn-primary">Logout</a>
      </span>

    <?php else : ?>

      <h5 class="card-header">Login</h5>
      <form action="includes/login.php" method="POST">
        <div class="card-body">
          <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Enter Username">
          </div>
          <div class="input-group">
            <input type="password" name="password" class="form-control" placeholder="Enter Password">
            <span class="input-group-btn">
              <button name="login" class="btn btn-secondary" type="submit">Submit</button>
            </span>
          </div>
          <div class="form-group">
            <a href="forgot.php?forgot=<?php echo uniqid(true); ?>"> Forgot Password?</a>
          </div>
        </div>
      </form>

    <?php endif; ?>


  </div>

</div>

</div>