<?php $currentUser = getUserByEmail($_SESSION['s_user_id']); ?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
   <a href="index.php"> <img src="assets/images/adverto-logo.png" class="logo mr-5" alt="logo" srcset=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-collapse" aria-controls="nav-collapse"  aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="nav-collapse">
      <ul class="navbar-nav user-navbar me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="../index.php">Home</a>
        </li>
         <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="change-password.php">Change Password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart(<?php echo countItemsInCart($_SESSION['s_user_id']) ?>)</a>
        </li>
      </ul>
        <div class="ml-auto">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto bg-secondary shadow round">
                              <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" class="dp-image mx-2" src="<?php echo $currentUser['avatar'] ?>" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block mr-5">Hi, <?php echo $currentUser['firstname'] . " " . $currentUser['lastname']; ?></div></a>
                    <div class="dropdown-menu dropdown-menu-right p-5">
                    
                        <a href="profile.php" class="dropdown-item has-icon"><i class="far fa-user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
                        </ul>
    </div>     
  </div>
</nav>