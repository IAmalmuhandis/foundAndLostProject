<?php require 'helpers/user_init.php'; ?>
<?php require 'helpers/_adverts.php'; ?>

<?php
$pageDetails = [
  'title' => "Adverts | Adverto"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

?>
<body class="bg-secondary">
    
    <!--Navigation bar-->
        <?php Includes::custom_include('includes/nav.php', [], true);    ?>
       <!--end of Navigation bar -->
       <div class="container my-1">
           <div class="row">
               <!-- row -->
               <div class="col-md-3 my-1">
                   <div class="card bg-primary">
                       <div class="card-body p-2 text-white shadow">
                           <h5 class="text-center">Products</h5>
                       </div>
                       <div class="card-body">
                           <a href="products.php" class="btn btn-secondary w-100">Manage Products</a>
                       </div>
                   </div>
               </div>
               <div class="col-md-3 my-1">
                   <div class="card bg-success">
                       <div class="card-body p-2 text-white shadow">
                           <h5 class="text-center">Adverts</h5>
                       </div>
                       <div class="card-body">
                           <a href="advert.php" class="btn btn-secondary w-100">Manage Adverts</a>
                       </div>
                   </div>
               </div>
               <div class="col-md-3 my-1">
                   <div class="card bg-danger">
                       <div class="card-body p-2 text-white shadow">
                           <h5 class="text-center">Orders</h5>
                       </div>
                       <div class="card-body">
                           <a href="orders.php" class="btn btn-secondary w-100">Manage Orders</a>
                       </div>
                   </div>
               </div>
               <div class="col-md-3 my-1">
                   <div class="card bg-info">
                       <div class="card-body p-2 text-white shadow">
                           <h5 class="text-center">Cart</h5>
                       </div>
                       <div class="card-body">
                           <a href="cart.php" class="btn btn-secondary w-100">Manage Cart</a>
                       </div>
                   </div>
               </div>

               <!-- eof row -->
           </div>
       </div>
   <!--manage advert page-->
   <div class="container-fluid">
       <div class="container py-5" >
               <div class="card bg-dark mx-auto text-white text-center" style="width: 50%;">
               <div class="card-body">
                   <div class="card-title">
                      <h4 class="text-center text-uppercase">
                           My Adverts
                           <button data-toggle="modal" data-target="#myModal" class="btn btn-success mx-5"><span class="fa fa-plus"></span> Add Advert</button>
                        </h4>
                           <?php if(isset($_GET['successMSG'])): ?>
                            <p class="card text-center text-success">
                                <?php echo $_GET['successMSG']; ?>
                            </p>
                        <?php endif ?>
                        <?php if(isset($_GET['errorMSG'])): ?>
                            <p class="card text-center text-success">
                                <?php echo $_GET['errorMSG']; ?>
                            </p>
                        <?php endif ?>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!--end of manage advert page-->
   <!--myAdvertList-->
   <div class="container-fluid">
<div class="row">


<?php while($advert = mysqli_fetch_assoc($user_adverts)): ?>

  <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 my-5">
    <div class="card h-100">
      <img src="../banners/<?php echo $advert['banner']; ?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo getProductById($advert['product_id'])['title']; ?></h5>
        <p class="card-text"><?php echo getProductById($advert['product_id'])['description']; ?></p>
        <p class="text-muted"><?php echo countPeopleReached($email, $advert['product_id']); ?> People Reached</p>
      </div>
      <div class="card-footer d-flex justify-content-between">
                 <div class="price-frame bg-dark text-white p-2">
                        <p class="card__price my-auto">&#8358;<?php echo $advert['advert_price']; ?></p>
                 </div>
                <div class="btn

                <?php if($advert['status'] == 'Accepted'){
                  echo "btn-success";
                }else if ($advert['status'] == 'In Review'){
                  echo "btn-warning";
                }else if($advert['status'] =='Declined'){
                  echo "btn-danger";
                } ?>

                "><?php echo $advert['status']; ?></div>
                </div>
    </div>
  </div>

  <?php endwhile; ?>

    </div>
   </div>
   <!--end of myAdvertList-->
   
<!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add an Advert</h4>
            <button type="button" class="close" data-dismiss="modal">
              &times;
            </button>
          </div>
          <!-- Form for sending message -->
         <form action="" method="POST"
                autocomplete="off" enctype="multipart/form-data">

              <!-- Modal body -->
          <div class="modal-body">
            <div class="form-group">
                <label for="">Advert ID:</label>
    <input type="text" class="form-control" readonly value="<?php echo md5(rand(1, 10000)); ?>" name="advert_id">  
            </div>
            <div class="form-group">
                <label for="">Products:</label>
                <select name="product_id" class="custom-select form-control">
                    <?php while($results = mysqli_fetch_assoc($user_products)): ?>
                        <option value="<?php echo $results['product_id'] ?>"><?php echo $results['title'] . " - " . getCategoryById($results['category_id']); ?></option>
                    <?php endwhile;?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Advert Price:</label>
                <input type="text" class="form-control" placeholder="Enter Product Price" name="advert_price">
            </div>
            <div class="form-group">
              <label for="">Advert Banner:</label>
              <div class="custom-file">
                <input type="file" name="banner" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" name="addAdvert" class="btn btn-success">
              Save
            </button>
         </form>
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
<?php Includes::custom_include('includes/footer.php', [], true);    ?>