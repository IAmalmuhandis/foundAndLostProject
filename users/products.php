<?php require 'helpers/user_init.php'; ?>
<?php require 'helpers/_products.php'; ?>

<?php
$pageDetails = [
  'title' => "Products | Adverto"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

?>
<body class="bg-secondary">
    
    <!--Navigation bar-->
        <?php Includes::custom_include('includes/nav.php', [], true);    ?>
       <!--end of Navigation bar -->

       <!-- Dashboard index page-->
       <div class="container my-2">
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

           <div class="container">
               <div class="card mt-2 bg-secondary shadow text-white">
                   <div class="card-body shadow-sm">
                       <h4 class="text-center text-uppercase">
                           My Products
                           <button data-toggle="modal" data-target="#myModal" class="btn btn-primary mx-5"><span class="fa fa-plus"></span> Add Product</button>
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
                  <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Product ID</th>
                                <th>Product Title</th>
                                <th>Product Description</th>
                                <th>Product Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="text-white">
                        <?php $counter = 1; ?>
                        <?php while($product = mysqli_fetch_assoc($user_products)): ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $product['product_id']; ?></td>
                                <td><?php echo $product['title']; ?></td>
                                <td><?php echo $product['description']; ?></td>
                                <td>&#8358;<?php echo $product['product_price']; ?></td>
                                <td>
                                    <a href="#" class="btn btn-success">View</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                            </tbody>
                        </table>
                  </div>
               </div>
           </div>
       </div>

<!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add a New Product</h4>
            <button type="button" class="close" data-dismiss="modal">
              &times;
            </button>
          </div>
          <!-- Form for sending message -->
         <form action="" method="POST"
                autocomplete="off">

              <!-- Modal body -->
          <div class="modal-body">
            <div class="form-group">
                <label for="">Produt ID:</label>
    <input type="text" class="form-control" readonly value="<?php echo md5(rand(1, 1000)); ?>" name="product_id">  
            </div>
            <div class="form-group">
                <label for="">Product Title:</label>
                <input type="text" class="form-control" placeholder="Enter Product Title" name="product_title">
            </div>
            <div class="form-group">
                <label for="">Product Price:</label>
                <input type="text" class="form-control" placeholder="Enter Product Price" name="product_price">
            </div>
            <div class="form-group">
                <label for="">Product Category:</label>
                <select name="product_category" class="custom-select form-control">
                    <?php while($results = mysqli_fetch_assoc($cat_results)): ?>
                        <option value="<?php echo $results['id'] ?>"><?php echo $results['title'] ?></option>
                    <?php endwhile;?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Product Description</label>
                <textarea name="product_description" id="" cols="3" class="form-control" rows="3"></textarea>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" name="addProduct" class="btn btn-success">
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