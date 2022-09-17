<?php require 'helpers/user_init.php'; ?>
<?php require 'helpers/_profile.php'; ?>

<?php
$pageDetails = [
  'title' => "Profile | Adverto"
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
              <div class="col-lg-8 offset-md-2">
                <div class="card">
                  <div class="card-body text-center">
                    <h4 class="text-primary">Profile Settings</h4>
                  </div>
                  <div class="card-header mt-n3">
                      <div class="text-center">
                            <?php
                                if (isset($Msg)) {
                                    echo $Msg;
                                }
                            ?>
                        </div>
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                      <h4 class="text-center"><u>Edit Profile</u></h4>
                      <div class="form-group">
                        <button
                          type="button"
                          class="btn resetStyle"
                          id="getBtnUpload"
                        >
                          <img
                            src="<?php echo getUserByEmail($email)['avatar']; ?>"
                            class="img-fluid w-25  d-block resetStyle"
                            alt=""
                            title="Change Avatar"
                          />
                        </button>
                        <input
                          type="file"
                          name="avatar"
                          id="avatarUpload"
                        />
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="fname">First Name:</label>
                          <input
                            type="text"
                            class="form-control"
                            id="fname"
                            name="firstname"
                            value="<?php echo getUserByEmail($email)['firstname']; ?>"
                          />
                        </div>
                        <div class="form-group col-md-6">
                          <label for="lname">Last Name:</label>
                          <input
                            type="text"
                            class="form-control"
                            id="lname"
                            name="lastname"
                            value="<?php echo getUserByEmail($email)['lastname']; ?>"
                          />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email:</label>
                            <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            value="<?php echo getUserByEmail($email)['email']; ?>"
                            readonly
                            />
                         </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Phone Number:</label>
                            <input
                            type="text"
                            class="form-control"
                            id="phone"
                            name="phone"
                            value="<?php echo getUserByEmail($email)['phone']; ?>"
                            />
                         </div>
                        <div class="form-group col-md-12">
                            <label for="phone">Delivery Address:</label>
                            <textarea name="delivery_address" id="" cols="3" rows="3" class="form-control">
                            <?php echo getUserByEmail($email)['delivery_address']; ?>
                            </textarea>
                         </div>

                    </div>
                      <button type="submit" name="edit_profile" class="btn btn-secondary w-100">
                        Edit Profile
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
       <!-- end of Dashboard index page-->
<?php Includes::custom_include('includes/footer.php', [], true);    ?>