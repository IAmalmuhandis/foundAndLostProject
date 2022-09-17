<?php require 'helpers/user_init.php' ?>
<?php require 'helpers/_user_login.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/css/all.min.css">
    <link rel="stylesheet" href="assets/app.js">
    <link rel="stylesheet" href="assets/style.css">
    <title>Log In</title>
</head>
<body>
     <!--Navigation bar-->
   <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
   <a href="../index.php"><img src="assets/images/adverto-logo.png" width="60" class="logo mr-5" alt="logo"/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-collapse" aria-controls="nav-collapse"  aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="nav-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link ">About</a>
        </li>
      </ul>
      <div class="toFormBtn mx-5 d-flex justify-content-between my-2 text-center ml-auto">
         <a href="signUp.php"> <button class="btn btn-outline-success mx-2">SignUp</button></a>
         <a href="logIn.php">      <button class="btn btn-outline-danger ">LogIn</button>
        <a href="../admin/index.php"><button class="btn btn-success">ADMIN</button></a>
</a>
      </div>
    </div>
  </div>
</nav>
       <!--end of Navigation bar-->
     <div class="container-fluid py-5">
           <!--Sign up form-->
       <div class="container bg-secondary rounded shadow py-5 my-3">
           <h2 class="text-white py-3 text-center">Log into existing account</h2>
<form action="" method="POST">
       <span class="text-white text-center">
                <?php if (isset($userMsgs['credentialErr'])) {
                  echo $userMsgs['credentialErr'];
                } ?>
              </span>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" name="email" class="form-control" placeholder="Enter email" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" name="password" class="form-control" placeholder="Enter password" id="pwd">
  </div>
  <div class="d-flex justify-content-between">
   <p class="text-white lead float-left">Don't have an account? <a href="signUp.php">Create account</a></p>
      <button type="submit" name="loginUser" class="btn btn-primary float-right">Submit</button>
</div>
   
</form>
       </div>
       <!--end of Sign up form-->
     </div>

      <footer class="bg-dark py-5 mt-5 ">
          <!--Footer body-->
          <div class="container py-2">
              <p class="lead text-white text-center">
            Adverto is optimized for advertisment. Contents are constantly reviewed to avoid issues, but we cannot warrant full correctness of all content. While using Adverto, you agree to have read and accepted our terms of use, cookie and privacy policy.
              </p>
              <p class="lead text-white text-center">
             Copyright 2021. All right reserved. <br>
             Designed by Yahya Anka
              </p>

          </div>
    
      <!--end of Footer body-->
     </footer>
  <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>