<?php require 'helpers/user_init.php'; ?>
<?php require "helpers/_change-password.php" ?>

<?php
$pageDetails = [
  'title' => "Dashboard | Adverto"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

?>
<body class="bg-secondary">
    
    <!--Navigation bar-->
        <?php Includes::custom_include('includes/nav.php', [], true);    ?>
       <!--end of Navigation bar -->

       <!-- Dashboard index page-->
       <div class="container my-5">
           <div class="row">
               <!-- row -->
               
               <div class="card col-md-6 offset-md-3">
                    <div class="card-body border m-3 shadow-sm">
                        <h4 class="text-center text-secondar">(Change Password)</h4>
                        <form class="row g-3 " action="" method="POST">
                            <span class="text-success">
                                <?php if (isset($msgs['passSucc'])) {
                                    echo $msgs['passSucc'];
                                }  ?></span>
                            <span class="text-danger">
                                <?php if (isset($msgs['passErr'])) {
                                    echo $msgs['passErr'];
                                }  ?></span>
                            <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="floatingPassword1">Old Password</label>
                                <input type="password" name="oldpass" class="form-control shadow-sm" id="floatingPassword1" placeholder="Enter Old Password"  />
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="floatingPassword2">New Password</label>
                                <input type="password" name="newpass" class="form-control shadow-sm" id="floatingPassword2" placeholder="Enter New Password"/>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="floatingPassword3">Confirm New Password</label>
                                <input type="password" name="cnewpass" class="form-control shadow-sm" id="floatingPassword3" placeholder="Enter New Password"  />
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" name="changepassword" class="btn btn-secondary
                                 float-end">
                                    Change Password <i class="mdi mdi-lock"></i>
                                </button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>

               <!-- eof row -->
           </div>
       </div>
       <!-- end of Dashboard index page-->
<?php Includes::custom_include('includes/footer.php', [], true);    ?>