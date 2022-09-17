<?php require 'helpers/user_init.php'; ?>
<?php require 'helpers/_index.php'; ?>

<?php
$pageDetails = [
  'title' => "Dashboard | Adverto"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

$peopleReached = 0;
while ($product = mysqli_fetch_assoc($user_products)) {
$peopleReached += countPeopleReached($product['owner'], $product['product_id']);
}

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
                       <h4 class="text-center text-uppercase">Dashboard</h4>
                   </div>
                  <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card bg-success">
                                <div class="card-body shadow-sm">
                                    <h4 class="d-inline">Clicks</h4>
                                    <span class="fas fa-chart-bar fa-2x"></span>
                                </div>
                                <div class="card-body">
                                    <p class="">
                                    <span><?php echo $peopleReached; ?> People are reached</span>
                                    </p>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-danger">
                                <div class="d-flex shadow-sm justify-content-between card-body">
                                    <div>
                                        <h4 class="d-inline">Cart</h4>
                                        <span class="fas fa-cart-plus fa-2x"></span>
                                    </div>
                                    <div class="ml-auto">
                                        <h4 class="d-inline">Orders </h4>
                                        <span class="fas fa-money-check fa-2x"></span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="d-flex justify-content-between card-body">
                                    <p class="">(<?php echo countItemsInCart($_SESSION['s_user_id']) ?>) Items in Cart</p>

                                    <p class="">(<?php echo countItemsOrdered($_SESSION['s_user_id']) ?>) Items Ordered</p>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="card my-3 text-dark">
                            <div class="card-body bg-info">
                                <h4 class="text-center">My Customers</h4>
                            </div>
                            <div class="card-body">
                                 <table class="table table-hover text-dark">
                       <thead>
                               <th>#</th>
                               <th>Product Title</th>
                               <th>Customer Name</th>
                               <th>Delivery Address</th>
                               <th>Order Date</th>
                               <th>Amount</th>
                               <th>Quantity</th>
                               <th>Action</th>
                       </thead>
                           <tbody>
                        <?php $counter = 1; ?>
                        <?php while($order = mysqli_fetch_assoc($orders)): ?>
                    <tr>
                            <td class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                    <?php echo $counter++; ?>
                            </td>
                            <td class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                <?php echo getProductById($order['product_id'])['title'] ?>
                            </td>
                            <td class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                <?php echo getUserByEmail($order['buyer_id'])['firstname'] . " " . getUserByEmail($order['buyer_id'])['lastname'] ?>
                            </td>
                            <td class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                <?php echo getUserByEmail($order['buyer_id'])['delivery_address'] ?>
                            </td>
                            <td class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                <?php echo $order['datetime'] ?>
                            </td>
                            <td class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
                                <?php echo $order['amount']; ?>
                            </td>
                            <td class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                x<?php echo $order['quantity'] ?>
                            </td>
                            <td class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                <a href="?product_id=<?php echo $order['product_id'] ?>&buyer_id=<?php echo $order['buyer_id'] ?>" class="btn btn-success">Deliver</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                           </tbody>
                   </table>
                            </div>
                        </div>
                  </div>
               </div>
           </div>
       </div>
       <!-- end of Dashboard index page-->
<?php Includes::custom_include('includes/footer.php', [], true);    ?>