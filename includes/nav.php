<?php if(isUserLoggedIn()): ?>
  
  <?php
   if (!isset($_SESSION)) {
        session_start();
    }

  ?>
  
<?php $currentUser = getUserByEmail($_SESSION['s_user_id']); ?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
   <a href="index.php"> <img src="assets/images/adverto-logo.png" class="logo mr-5" alt="logo" srcset=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-collapse" aria-controls="nav-collapse"  aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="nav-collapse">
      <ul class="navbar-nav user-navbar me-auto mb-2 mb-lg-0">
        <li class="nav-item ">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" aria-current="page" href="users/index.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users/change-password.php">Change Password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users/cart.php">Cart(<?php echo countItemsInCart($_SESSION['s_user_id']) ?>)</a>
        </li>
      </ul>
        <div class="ml-auto text-white">
          <a href="users/profile.php" class="btn btn-outline-info">Hi, <?php echo getUserByEmail($_SESSION['s_user_id'])['firstname']; ?></a>
        </div>    
  </div>
</nav>


  <?php else: ?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
   <a href="index.php"> <img src="assets/images/adverto-logo.png" class="logo mr-5" alt="logo" srcset=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-collapse" aria-controls="nav-collapse"  aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="nav-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link ">About</a>
        </li>
      </ul>
      <div class="toFormBtn mx-5 my-2 text-center">
          <a href="users/signUp.php"><button class="btn btn-outline-success mx-2">SignUp</button></a>
      <a href="users/logIn.php"><button class="btn btn-outline-danger ">SignIn</button></a>
      <a href="admin/index.php"><button class="btn btn-success">ADMIN</button></a>
      </div>
    </div>
  </div>
</nav>

<?php endif; ?>